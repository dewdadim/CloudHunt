export function normalizePath(path: string): string {
  const parts = path.split('/').filter(Boolean);
  const normalizedParts: string[] = [];

  for (const part of parts) {
    if (part === '..') {
      normalizedParts.pop();
    } else if (part !== '.') {
      normalizedParts.push(part);
    }
  }

  return '/' + normalizedParts.join('/');
}

export function resolvePath(currentPath: string, targetPath: string): string {
  if (targetPath.startsWith('/')) {
    return normalizePath(targetPath);
  }
  return normalizePath(`${currentPath}/${targetPath}`);
}