/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './app/Views/**/*.php',
    './public/assets/js/**/*.js'
  ],
  theme: {
    extend: {
      colors: {
        forest: {
          950: '#132A21',
          900: '#18382B',
          800: '#214B38',
          700: '#2D6248',
          600: '#3C7657',
        },
        moss: '#6E8065',
        sage: {
          DEFAULT: '#AEBCA4',
          light: '#DDE5D8',
        },
        ivory: '#F7F4EC',
        'warm-white': '#FBFAF6',
        sand: '#EAE2D4',
        stone: '#CBC4B8',
        ink: '#18201C',
        body: '#555D58',
        muted: '#7C827E',
        gold: {
          DEFAULT: '#B89458',
          light: '#D4B87C',
        },
      },
      fontFamily: {
        serif: ['"Cormorant Garamond"', 'Georgia', 'serif'],
        sans: ['"Plus Jakarta Sans"', '"Inter"', 'system-ui', 'sans-serif'],
      },
      maxWidth: {
        'site': '1360px',
      },
      letterSpacing: {
        'widest-plus': '0.22em',
      },
    },
  },
  plugins: [],
}
