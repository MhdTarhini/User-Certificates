import { useToast } from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-sugar.css'

const toast = useToast()
export const successNotification = (text) => {
  return toast.success(`${text}`)
}
export const errorNotification = (text) => {
  return toast.error(`${text}`)
}
