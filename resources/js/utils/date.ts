import dayjs from 'dayjs';

export function formatDateTime(datetime: Parameters<typeof dayjs>[0]) {
  return dayjs(datetime).format('dddd, MMMM D, YYYY, hh:mm A')
}
