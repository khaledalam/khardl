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
    fontFamily: {
      jakarta: ["Plus Jakarta Sans", "sans-serif"],
      inter: ["Inter", "sans-serif"],
    },
    extend: {
      screens: {
        laptopL: "1440px",
        laptopXL: "1536px",
      },
    },
    extend: {
      keyframes: {
        wiggle: {
          "0%, 100%": { transform: "translateY(-5%)" },
          "50%": { transform: "translateY(5%)" },
        },
      },
      animation: {
        wiggle: "wiggle 1s ease-in-out infinite",
      },
    },
  },
  daisyui: {
    themes: ["light"],
    logs: false,
  },
  plugins: [require("daisyui")],
};
