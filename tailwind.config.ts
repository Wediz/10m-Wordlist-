import type { Config } from 'tailwindcss'

const config: Config = {
  content: [
    './pages/**/*.{js,ts,jsx,tsx,mdx}',
    './components/**/*.{js,ts,jsx,tsx,mdx}',
    './app/**/*.{js,ts,jsx,tsx,mdx}',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        gold: {
          50: '#FDF8EC',
          100: '#FAF0D0',
          200: '#F4E0A0',
          300: '#EDD070',
          400: '#E4C050',
          500: '#C9A84C',
          600: '#A8893D',
          700: '#876B2E',
          800: '#654D1F',
          900: '#432F10',
        },
        dark: {
          50: '#F0F0F0',
          100: '#D0D0D0',
          200: '#A0A0A0',
          300: '#707070',
          400: '#505050',
          500: '#303030',
          600: '#202020',
          700: '#161616',
          800: '#0F0F0F',
          900: '#0A0A0A',
          950: '#050505',
        },
      },
      fontFamily: {
        sans: ['var(--font-inter)', 'system-ui', 'sans-serif'],
        display: ['var(--font-playfair)', 'Georgia', 'serif'],
      },
      animation: {
        'fade-up': 'fadeUp 0.8s ease-out forwards',
        'fade-in': 'fadeIn 1s ease-out forwards',
        'shimmer': 'shimmer 3s linear infinite',
        'float': 'float 6s ease-in-out infinite',
        'pulse-gold': 'pulseGold 2s ease-in-out infinite',
        'slide-up': 'slideUp 0.6s ease-out forwards',
      },
      keyframes: {
        fadeUp: {
          '0%': { opacity: '0', transform: 'translateY(40px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        shimmer: {
          '0%': { backgroundPosition: '0% center' },
          '100%': { backgroundPosition: '200% center' },
        },
        float: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-20px)' },
        },
        pulseGold: {
          '0%, 100%': { boxShadow: '0 0 0 0 rgba(201,168,76,0.4)' },
          '50%': { boxShadow: '0 0 0 20px rgba(201,168,76,0)' },
        },
        slideUp: {
          '0%': { opacity: '0', transform: 'translateY(20px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
      },
      backgroundImage: {
        'gradient-gold': 'linear-gradient(135deg, #C9A84C 0%, #E4C570 50%, #C9A84C 100%)',
        'gradient-dark': 'linear-gradient(135deg, #0A0A0A 0%, #141414 100%)',
        'gradient-glass': 'linear-gradient(135deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.02) 100%)',
      },
      boxShadow: {
        'gold': '0 0 30px rgba(201,168,76,0.3)',
        'gold-lg': '0 0 60px rgba(201,168,76,0.4)',
        'glass': '0 8px 32px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.05)',
        'premium': '0 25px 50px rgba(0,0,0,0.5)',
      },
    },
  },
  plugins: [],
}

export default config
