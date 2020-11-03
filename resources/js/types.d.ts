export interface User {
  id: number
  name: string
  username: string
  email: string
  events?: Event[]
  ownedEvents?: Event[]
}

export interface Event {
  id: number
  name: string
  description: string
  datetime: string
  location: string
  organizer_id: number
  organizer?: User
  participants?: User[]
  items?: Item[]
}

export interface Item {
  id: number
  name: string
  description?: string
  quantity?: number
  event_id: number
  event?: Event
}
