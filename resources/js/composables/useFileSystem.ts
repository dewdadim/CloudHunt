import { defaultFileSystem } from '@/data/defaultFileSystem'
import { ref } from 'vue'

export function useFileSystem() {
  const fileSystem = ref<DummyFileSystem>(defaultFileSystem)

  const getNodeAtPath = (path: string): DummyFileSystem | null => {
    const parts = path.split('/').filter(Boolean)
    let current = fileSystem.value

    for (const part of parts) {
      if (!current[part] || current[part].type !== 'directory') {
        return null
      }
      current = current[part].children || {}
    }

    return current
  }

  const createDirectory = (path: string, dirName: string): boolean => {
    const node = getNodeAtPath(path)
    if (!node) return false

    if (node[dirName]) {
      return false // Directory already exists
    }

    node[dirName] = {
      type: 'directory',
      children: {},
    }

    return true
  }

  const isValidPath = (path: string): boolean => {
    return getNodeAtPath(path) !== null
  }

  const createFile = (path: string, fileName: string): boolean => {
    const node = getNodeAtPath(path)
    if (!node) return false

    if (node[fileName]) return false

    node[fileName] = {
      type: 'file',
      content: '',
    }

    return true
  }

  return {
    fileSystem,
    getNodeAtPath,
    isValidPath,
    createDirectory,
    createFile,
  }
}
