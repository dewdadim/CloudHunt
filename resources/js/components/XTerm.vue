<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { Terminal } from '@xterm/xterm'
import { FitAddon } from '@xterm/addon-fit'
import { WebLinksAddon } from '@xterm/addon-web-links'
import '@xterm/xterm/css/xterm.css'
import { useTerminalCommands } from '../composables/useTerminalCommands'
import { useTerminalHistory } from '../composables/useTerminalHistory'
import { useAutoComplete } from '../composables/useAutoComplete'
import { usePage } from '@inertiajs/vue3'

const props = defineProps<{
  dissableHelpCommand?: boolean
}>()

const user = usePage().props.auth.user
const terminalRef = ref<HTMLElement | null>(null)
const terminal = ref<Terminal | null>(null)
const currentPath = ref('/home/user')
const currentCommand = ref('')

const { executeCommand } = useTerminalCommands(props.dissableHelpCommand)
const { addToHistory, getPreviousCommand, getNextCommand } =
  useTerminalHistory()
const { completeCommand, getCompletions } = useAutoComplete()

const clearLine = () => {
  if (!terminal.value) return
  const promptLength = getPrompt().length
  terminal.value.write(
    '\r' + ' '.repeat(promptLength + currentCommand.value.length) + '\r',
  )
  writePrompt()
}

const updateCommandLine = (newCommand: string) => {
  clearLine()
  currentCommand.value = newCommand
  terminal.value?.write(newCommand)
}

onMounted(() => {
  if (!terminalRef.value) return

  terminal.value = new Terminal({
    cursorBlink: true,
    theme: {
      background: '#1e1e1e',
      foreground: '#ffffff',
    },
    fontSize: 15,
    fontWeight: 'bold',
    fontFamily: 'Menlo, Monaco, "Courier New", monospace',
  })

  const fitAddon = new FitAddon()
  const webLinksAddon = new WebLinksAddon()

  terminal.value.loadAddon(fitAddon)
  terminal.value.loadAddon(webLinksAddon)

  terminal.value.open(terminalRef.value)
  fitAddon.fit()

  writePrompt()

  terminal.value.onKey(({ key, domEvent }) => {
    const ev = domEvent as KeyboardEvent

    if (ev.key === 'Enter') {
      terminal.value?.writeln('')
      if (currentCommand.value.trim()) {
        addToHistory(currentCommand.value)
        const result = executeCommand(currentCommand.value, currentPath.value)
        if (result.output) {
          terminal.value?.writeln(result.output)
        }
        if (result.newPath) {
          currentPath.value = result.newPath
        }
      }
      currentCommand.value = ''
      writePrompt()
    } else if (ev.key === 'Backspace') {
      if (currentCommand.value.length > 0) {
        currentCommand.value = currentCommand.value.slice(0, -1)
        terminal.value?.write('\b \b')
      }
    } else if (ev.key === 'Tab') {
      ev.preventDefault()
      const completedCommand = completeCommand(
        currentCommand.value,
        currentPath.value,
      )
      if (completedCommand !== currentCommand.value) {
        updateCommandLine(completedCommand)
      } else {
        const completions = getCompletions(
          currentCommand.value,
          currentPath.value,
        )
        if (completions.length > 1) {
          terminal.value?.writeln('')
          terminal.value?.writeln(completions.join('  '))
          writePrompt()
          terminal.value?.write(currentCommand.value)
        }
      }
    } else if (ev.key === 'ArrowUp') {
      const prevCommand = getPreviousCommand()
      if (prevCommand !== undefined) {
        updateCommandLine(prevCommand)
      }
    } else if (ev.key === 'ArrowDown') {
      const nextCommand = getNextCommand()
      updateCommandLine(nextCommand)
    } else if (!ev.ctrlKey && !ev.altKey && key.length === 1) {
      currentCommand.value += key
      terminal.value?.write(key)
    }
  })

  window.addEventListener('resize', () => {
    fitAddon.fit()
  })
})

const getPrompt = () => {
  return `\x1b[32m${user.prefer_name ?? 'user'}@cloudhunt\x1b[0m:\x1b[34m${currentPath.value}\x1b[0m$ `
}

const writePrompt = () => {
  terminal.value?.write(getPrompt())
}
</script>

<template>
  <div class="rounded-2xl border bg-card p-0.5 shadow-taper">
    <div class="relative flex items-center p-3">
      <div class="flex gap-2">
        <div class="size-3 rounded-full bg-red-500"></div>
        <div class="size-3 rounded-full bg-emerald-500"></div>
        <div class="size-3 rounded-full bg-yellow-500"></div>
      </div>
      <div class="absolute flex w-full items-center justify-center px-3">
        <p>Terminal - {{ user.prefer_name }}</p>
      </div>
    </div>
    <div class="h-96 w-full rounded-2xl rounded-t-none bg-[#1e1e1e] p-4">
      <div ref="terminalRef" class="h-full w-full"></div>
    </div>
  </div>
</template>
