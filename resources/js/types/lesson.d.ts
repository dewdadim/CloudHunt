interface Lesson {
  id: number
  uri: string
  modules: Module[]
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
  // id: string
  // user_id: number
  // lesson_id: number
  // module_id: number
  // completed: boolean
  // created_at: Date
  // updated_at: Date
  [key: number]: {
    completed: boolean
  }
}
