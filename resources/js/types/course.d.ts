interface Course {
  id: number
  uri: string
  chapters: Chapter[]
  title: string
  created_at: Date
  updated_at: Date
}

interface Lesson {
  id: number
  uri: string
  modules: Module[]
  title: string
  description: string
  created_at: Date
  updated_at: Date
}

interface Chapter {
  id: number
  uri: string
  modules: Module[]
  title: string
  course_id: string
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
  created_at: Date
  updated_at: Date
}
