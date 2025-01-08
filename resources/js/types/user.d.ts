interface User {
  id: number
  full_name: string
  prefer_name: string
  username: string
  email: string
  avatar: string
  occupation: string
  interest: string
  date_of_birth: Date
  created_at: Date
}

interface AuthUser {
  id: number
  username: string
  prefer_name: string
  avatar: string
  xp: number
}

interface Onboard {
  full_name: string | undefined
  prefer_name: string | undefined
  // username: string | undefined
  date_of_birth: DateValue | DateValue[] | undefined
  occupation: string | undefined
  interest?: string | undefined
}
