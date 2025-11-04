/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php", 
    './app/Livewire/**/*Table.php',
    './resources/views/vendor/livewire-powergrid/**/*.php',
    './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php'
  ],
  theme: {
    extend: {
    },
  },
  plugins: [require("rippleui"), require('@tailwindcss/forms')],
  rippleui: {
		removeThemes: ["dark"],
	},
}
