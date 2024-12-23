import { ref } from 'vue'

export function useFileSystem() {
  const fileSystem = ref<FileSystem>({
    home: {
      type: 'directory',
      children: {
        user: {
          type: 'directory',
          children: {
            documents: {
              type: 'directory',
              children: {
                'hello.txt': {
                  type: 'file',
                  content: 'Hello, World!',
                },
              },
            },
          },
        },
      },
    },
  })

  const getNodeAtPath = (path: string): FileSystem | null => {
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

  const isValidPath = (path: string): boolean => {
    return getNodeAtPath(path) !== null
  }

  return {
    fileSystem,
    getNodeAtPath,
    isValidPath,
  }
}
