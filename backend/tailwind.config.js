/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./src/**/*.{js,jsx,ts,tsx}",
    "./resources/tenant/**/*.{js,jsx,ts,tsx}",
    "./resources/**/*.{blade.php,js,jsx,ts,tsx,css,vue}",
  ],
  theme: {
    extend: {
      screens: {
        laptopL: "1440px",
        laptopXL: "1536px",
      },
    },
  },
  daisyui: {
    themes: ["light"],
      logs: false
  },
  plugins: [require("daisyui")],
}
