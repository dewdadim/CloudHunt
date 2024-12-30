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
import { ZoomIn, ZoomOut } from 'lucide-vue-next'

const props = defineProps<{
  dissableHelpCommand?: boolean
}>()

const emit = defineEmits(['command-input'])

const user = usePage().props.auth.user
const terminalRef = ref<HTMLElement | null>(null)
const terminal = ref<Terminal | null>(null)
const currentPath = ref('/home/user')
const currentCommand = ref('')
const fontSize = ref(15)

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
      background: '#242424',
      foreground: '#ffffff',
    },
    lineHeight: 1.2,
    fontSize: fontSize.value,
    fontWeight: '500',
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
        emit('command-input', currentPath.value, currentCommand.value)
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
    <div class="relative flex items-center justify-between p-3">
      <div class="flex gap-2">
        <div class="size-3 rounded-full bg-red-500"></div>
        <div class="size-3 rounded-full bg-emerald-500"></div>
        <div class="size-3 rounded-full bg-yellow-500"></div>
      </div>
      <div class="absolute flex w-full items-center justify-center px-3">
        <p>Terminal - {{ user.prefer_name }}</p>
      </div>
      <div class="absolute right-5 top-12 z-10 flex gap-1">
        <button
          @click="
            () => {
              if (terminal) {
                terminal.options.fontSize = fontSize -= 1
              }
            }
          "
          class="rounded-md bg-white/30 p-1 hover:bg-white/50"
        >
          <ZoomOut :size="20" />
        </button>
        <button
          @click="
            () => {
              if (terminal) {
                terminal.options.fontSize = fontSize += 1
              }
            }
          "
          class="rounded-md bg-white/30 p-1 hover:bg-white/50"
        >
          <ZoomIn :size="20" />
        </button>
      </div>
    </div>
    <div
      class="h-96 w-full rounded-2xl rounded-t-none bg-[#242424] p-2 pb-4 pr-0"
    >
      <div ref="terminalRef" class="h-full w-full overflow-hidden"></div>
    </div>
  </div>
</template>
