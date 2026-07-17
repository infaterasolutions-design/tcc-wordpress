/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./template-parts/**/*.php",
    "./assets/js/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        'tcc-bg': '#faf9f6',
        'tcc-beige': '#e5dfd5',
        'tcc-beige-light': '#e8e0d5',
        'tcc-dark': '#000000',
        'tcc-gray': '#555555',
        'tcc-gray-light': '#888888',
        'tcc-gray-lighter': '#999999',
        'tcc-pink': '#cc8e8e',
      },
      fontFamily: {
        'sans': ['Inter', 'sans-serif'],
        'serif': ['"Playfair Display"', 'serif'],
        'script': ['"Great Vibes"', 'cursive'],
      }
    },
  },
  plugins: [],
}
