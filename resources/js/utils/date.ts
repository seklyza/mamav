import dayjs from 'dayjs';

export function formatDateTime(datetime: string) {
  return dayjs(`${datetime} UTC`).format('dddd, MMMM D, YYYY, hh:mm A') // all dates are UTC
}
