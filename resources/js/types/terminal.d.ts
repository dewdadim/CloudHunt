interface FileSystem {
  [key: string]: {
    type: 'file' | 'directory'
    content?: string
    children?: FileSystem[] | FileSystem | undefined
  }
}

interface CommandResult {
  output: string
  newPath?: string
}
