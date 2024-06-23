/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"

  ],
  theme: {
    extend: {},
    fontFamily:{
      'National':"Protest Riot",
      'Human':"Bebas Neue",
      'Pop':"Poppins",
      'Rob':"Roboto",
      'Lob':"Lobster"
    }
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

