interface DummyFileSystem {
  [key: string]: {
    type: 'file' | 'directory'
    content?: string
    children?: DummyFileSystem
  }
}

interface CommandResult {
  output: string
  newPath?: string
}
