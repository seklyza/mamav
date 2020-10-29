// const {colors} = require('tailwindcss/defaultTheme')

module.exports = {
  future: {
    // removeDeprecatedGapUtilities: true,
    // purgeLayersByDefault: true,
  },
  purge: ['resources/js/**/*.vue'],
  theme: {
    extend: {
      colors: {
        primary: '#181fae',
      },
    },
    inset: {
      '16px': '16px',
    },
  },
  variants: {},
  plugins: [],
}
