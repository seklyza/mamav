export function copyToClipboard(text: string): void {
  const input = document.createElement('input')
  input.style.position = 'absolute'
  input.style.left = '-9999px'
  document.body.appendChild(input)
  input.value = text
  input.select()
  document.execCommand('copy')
  document.body.removeChild(input)
}
