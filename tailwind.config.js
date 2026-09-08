/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './template-parts/**/*.php',
    './assets/js/*.js',
  ],
  theme: {
    extend: {
      colors: {
        primary: 'var(--primary)',
        secondary: 'var(--secondary)',
        coff_black: 'var(--coff_black)',
        coffLightGreen: 'var(--coffLightGreen)',
        coffGreen: 'var(--coffGreen)',
        secondaryLight: 'var(--secondaryLight)',
        coffLightGreen: 'var(--coffLightGreen)',
      },
    },
  },
  plugins: [],
}
