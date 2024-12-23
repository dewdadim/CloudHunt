interface Lesson {
  id: number
  uri: string
  modules: Module[]
  thumbnail: string
  title: string
  description: string
  completed: boolean
  created_at: Date
  updated_at: Date
}

interface Module {
  id: number
  uri: string
  title: string
  description: string
  lesson_id: string
  category: 'learn' | 'test'
  difficulty: 'easy' | 'moderate' | 'hard'
  completed: boolean
  created_at: Date
  updated_at: Date
}

interface Progress {
  [key: number]: {
    completed: boolean
  }
}

interface Task {
  title: string
  module_id: number
  content: any
}
