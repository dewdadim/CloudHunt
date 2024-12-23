import { useFileSystem } from './useFileSystem'
import { resolvePath } from '../utils/pathUtils'

export function useTerminalCommands(dissableHelpCommand: boolean = false) {
  const { getNodeAtPath, isValidPath } = useFileSystem()

  const executeCommand = (
    command: string,
    currentPath: string,
  ): CommandResult => {
    const [cmd, ...args] = command.trim().split(' ')

    switch (cmd) {
      case 'cd':
        return handleCd(args[0] || '', currentPath)
      case 'ls':
        return { output: handleLs(currentPath) }
      case 'pwd':
        return { output: currentPath }
      case 'echo':
        return { output: args.join(' ') }
      case 'cat':
        return { output: handleCat(args[0], currentPath) }
      case 'clear':
        return { output: '\x1bc' }
      case 'help':
        return dissableHelpCommand
          ? { output: `Command not found: ${cmd}` }
          : { output: getHelpText() }
      default:
        return { output: `Command not found: ${cmd}` }
    }
  }

  const handleCd = (path: string, currentPath: string): CommandResult => {
    if (!path) {
      return { output: '', newPath: '/home/user' }
    }

    const newPath = resolvePath(currentPath, path)

    if (!isValidPath(newPath)) {
      return { output: `cd: no such directory: ${path}` }
    }

    return { output: '', newPath }
  }

  const handleLs = (path: string): string => {
    const node = getNodeAtPath(path)
    if (!node) return 'Invalid path'

    return Object.entries(node)
      .map(([name, item]) => {
        if (item.type === 'directory') {
          return `\x1b[34m${name}/\x1b[0m`
        }
        return name
      })
      .join('\n')
  }

  const handleCat = (filename: string, path: string): string => {
    const node = getNodeAtPath(path)
    if (!node) return 'Invalid path'

    if (node[filename]?.type === 'file') {
      return node[filename].content || ''
    }

    return `cat: ${filename}: No such file`
  }

  const getHelpText = (): string => {
    return `Available commands:
  cd [path] - Change directory
  ls - List directory contents
  pwd - Print working directory
  echo - Display a message
  cat - Display file contents
  clear - Clear the terminal screen
  help - Show this help message`
  }

  return {
    executeCommand,
  }
}
