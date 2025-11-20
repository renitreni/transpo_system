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
      keyframes: {
        'glow-red': {
          '0%, 100%': { 
            boxShadow: '0 0 5px 2px rgba(239, 68, 68, 0.5)'
          },
          '50%': { 
            boxShadow: '0 0 20px 4px rgba(231, 9, 9, 0.8)'
          },
        },
        'glow-yellow': {
          '0%, 100%': { 
            boxShadow: '0 0 5px 2px rgba(234, 179, 8, 0.5)'
          },
          '50%': { 
            boxShadow: '0 0 30px 4px rgba(234, 179, 8, 0.6)'
          },
        },
        'glow-green': {
          '0%, 100%': { 
            boxShadow: '0 0 5px 2px rgba(34, 197, 94, 0.5)'
          },
          '50%': { 
            boxShadow: '0 0 30px 4px rgba(34, 197, 94, 0.6)'
          },
        },
      },
    },
  },
  plugins: [require("rippleui"), require('@tailwindcss/forms')],
  rippleui: {
		removeThemes: ["dark"],
	},
}
