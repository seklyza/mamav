export interface User {
  id: string;
  name: string;
  username: string;
  email: string;
  events?: Event[]
  ownedEvents?: Event[]
}

export interface Event {
  id: string;
  name: string;
  description: string;
  datetime: string;
  location: string;
  organizer?: User
  participants?: User[]
}
