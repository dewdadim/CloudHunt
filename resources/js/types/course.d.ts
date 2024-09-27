interface Course {
  id: number
  uri: string
  chapters: Chapter[]
  title: string
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
  chapter_id: string
  category: 'video' | 'activity' | 'quiz'
  difficulty: 'easy' | 'moderate' | 'hard'
  isDone: boolean
  created_at: Date
  updated_at: Date
}
