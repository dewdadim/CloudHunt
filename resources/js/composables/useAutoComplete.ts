import { useFileSystem } from './useFileSystem';
import { resolvePath } from '../utils/pathUtils';

export function useAutoComplete() {
  const { getNodeAtPath } = useFileSystem();

  const getCompletions = (input: string, currentPath: string): string[] => {
    const parts = input.split(' ');
    const lastPart = parts[parts.length - 1];
    
    // If we're working with a path
    if (lastPart.includes('/')) {
      const parentPath = lastPart.substring(0, lastPart.lastIndexOf('/') + 1);
      const searchTerm = lastPart.substring(lastPart.lastIndexOf('/') + 1);
      const fullParentPath = resolvePath(currentPath, parentPath);
      const node = getNodeAtPath(fullParentPath);
      
      if (!node) return [];
      
      return Object.keys(node)
        .filter(name => name.startsWith(searchTerm))
        .map(name => {
          const isDir = node[name].type === 'directory';
          return parentPath + name + (isDir ? '/' : '');
        });
    }
    
    // If we're at the start of the command or in the middle
    const node = getNodeAtPath(currentPath);
    if (!node) return [];
    
    return Object.keys(node)
      .filter(name => name.startsWith(lastPart))
      .map(name => {
        const isDir = node[name].type === 'directory';
        return name + (isDir ? '/' : '');
      });
  };

  const completeCommand = (input: string, currentPath: string): string => {
    const completions = getCompletions(input, currentPath);
    
    if (completions.length === 0) return input;
    
    if (completions.length === 1) {
      const parts = input.split(' ');
      parts[parts.length - 1] = completions[0];
      return parts.join(' ');
    }
    
    return input;
  };

  return {
    completeCommand,
    getCompletions
  };
}