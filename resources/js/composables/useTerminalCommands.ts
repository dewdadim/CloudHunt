import { useFileSystem } from './useFileSystem'
import { resolvePath } from '../utils/pathUtils'

export function useTerminalCommands(dissableHelpCommand: boolean = false) {
  const { getNodeAtPath, isValidPath, createDirectory, createFile } =
    useFileSystem()

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
      case 'mkdir':
        return handleMkdir(args[0], currentPath)
      case 'touch':
        return handleTouch(args[0], currentPath)
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

  const handleTouch = (
    fileName: string,
    currentPath: string,
  ): CommandResult => {
    if (!fileName) {
      return { output: 'touch: missing operand' }
    }

    const success = createFile(currentPath, fileName)
    if (!success) {
      return {
        output: `touch: cannot create directory '${fileName}': File exists or invalid path`,
      }
    }

    return { output: '' }
  }

  const handleMkdir = (dirName: string, currentPath: string): CommandResult => {
    if (!dirName) {
      return { output: 'mkdir: missing operand' }
    }

    const success = createDirectory(currentPath, dirName)
    if (!success) {
      return {
        output: `mkdir: cannot create directory '${dirName}': File exists or invalid path`,
      }
    }

    return { output: '' }
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
      .join('\t')
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
  \r cd [path] - Change directory
  \r ls - List directory contents
  \r pwd - Print working directory
  \r echo - Display a message
  \r cat - Display file contents
  \r clear - Clear the terminal screen
  \r help - Show this help message`
  }

  return {
    executeCommand,
  }
}
