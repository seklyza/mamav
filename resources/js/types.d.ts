export interface User {
  id: number;
  name: string;
  username: string;
  email: string;
  events?: Event[]
  ownedEvents?: Event[]
}

export interface Event {
  id: number;
  name: string;
  description: string;
  datetime: string;
  location: string;
  organizer_id: number;
  organizer?: User
  participants?: User[]
}
