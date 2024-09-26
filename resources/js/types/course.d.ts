interface Course {
  id: number | undefined
  uri: string | undefined
  title: string | undefined
  created_at: Date | undefined
  updated_at: Date | undefined
}

interface Chapter {
  id: number | undefined
  title: string | undefined
  course_id: string | undefined
  created_at: Date | undefined
  updated_at: Date | undefined
}

interface Module {
  id: number | undefined
  title: string | undefined
  chapter_id: string | undefined
  created_at: Date | undefined
  updated_at: Date | undefined
}
