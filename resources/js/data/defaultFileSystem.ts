export const defaultFileSystem: DummyFileSystem = {
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
              notes: {
                type: 'directory',
                children: {
                  'todo.txt': {
                    type: 'file',
                    content:
                      '1. Learn TypeScript\r\n2. Master Vue.js\r\n3. Build awesome projects',
                  },
                },
              },
            },
          },
          projects: {
            type: 'directory',
            children: {
              web: {
                type: 'directory',
                children: {
                  'index.html': {
                    type: 'file',
                    content: `\r\n<!DOCTYPE html>\r\n<html>\r\n<body>\r\n\t<h1>My Project</h1>\r\n</body>\r\n</html>`,
                  },
                },
              },
              api: {
                type: 'directory',
                children: {
                  'README.md': {
                    type: 'file',
                    content: '# API Project\r\nThis is a sample API project.',
                  },
                },
              },
            },
          },
          downloads: {
            type: 'directory',
            children: {
              images: {
                type: 'directory',
                children: {},
              },
              music: {
                type: 'directory',
                children: {},
              },
            },
          },
        },
      },
    },
  },
}
