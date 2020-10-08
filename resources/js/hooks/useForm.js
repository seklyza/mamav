import { reactive, toRefs } from '@vue/composition-api'

const defaultValidator = () => false
export function useForm(...fields) {
  const form = fields.reduce(
    (allFields, field) => ({
      ...allFields,
      [field[0]]: {
        val: field[1],
        error: null,
        validate: field[2] || defaultValidator, // returns an error
      },
    }),
    {},
  )
  const state = reactive({ form: { ...form, isValid: true } })

  function clearValidity(input) {
    state.form[input].error = null
  }

  function validateForm() {
    state.form.isValid = true

    for (const field in state.form) {
      if (field === 'isValid') continue
      const error = state.form[field].validate(state.form[field].val)
      if (error) {
        state.form.isValid = false
        state.form[field].error = error
      }
    }
  }

  function handleSubmit() {
    validateForm()

    if (!state.form.isValid) return

    const formData = {}
    for (const field in state.form) {
      if (field === 'isValid') continue
      formData[field] = state.form[field].val
    }

    return formData
  }

  return {
    ...toRefs(state),

    clearValidity,
    handleSubmit,
  }
}
