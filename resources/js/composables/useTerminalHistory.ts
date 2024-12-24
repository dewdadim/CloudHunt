import { ref } from 'vue';

export function useTerminalHistory() {
  const history = ref<string[]>([]);
  const historyIndex = ref(-1);

  const addToHistory = (command: string) => {
    if (command.trim()) {
      history.value.push(command);
      historyIndex.value = history.value.length;
    }
  };

  const getPreviousCommand = (): string => {
    if (historyIndex.value > 0) {
      historyIndex.value--;
      return history.value[historyIndex.value];
    }
    return history.value[0] || '';
  };

  const getNextCommand = (): string => {
    if (historyIndex.value < history.value.length - 1) {
      historyIndex.value++;
      return history.value[historyIndex.value];
    }
    historyIndex.value = history.value.length;
    return '';
  };

  return {
    addToHistory,
    getPreviousCommand,
    getNextCommand,
  };
}