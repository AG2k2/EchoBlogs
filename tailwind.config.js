/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./View/**/*.{html,js,php}"],
  theme: {
    extend: {
      keyframes: {
        fullHeight: {
          from: { height: '0' },
          to: { height: '100%' },
        },
        zeroHeight: {
          from: { height: '100%' },
          to: { height: '0' },
        },
      },
      animation: {
        slideIn: 'fullHeight 0.25s ease-out',
        slideOut: 'zeroHeight 0.25s ease-out',
      },
      boxShadow: {
        shadowAround:'0px 0px 10px gray',
      }
    },
  },
  plugins: [],
}

