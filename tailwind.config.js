/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./*.html'],
  theme: {
    extend: {
      colors: {
        walnut: { DEFAULT: '#4A2C1A', dark: '#2D1A0E' },
        gold: { DEFAULT: '#C9A96E', light: '#E8D5A3', dark: '#A8884A' },
        champagne: '#F5E6C8',
        ivory: '#FFF8F0',
        cream: '#FAF0E6',
        ebony: '#1A1410',
        burgundy: '#6B2D3B',
        navy: '#1B2A4A',
        sage: '#8A9A8A',
        muted: '#8B7D72',
      },
      fontFamily: {
        bn: ['Noto Sans Bengali', 'sans-serif'],
        en: ['Poppins', 'sans-serif'],
        display: ['Playfair Display', 'serif'],
      },
    },
  },
  plugins: [],
};
