/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './storage/framework/views/*.php',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/**/*.blade.php',
  ],
  theme: {
    extend: {
      colors: {
        'primary-green': '#228B22',
        'dark-green': '#006400',
        'primary-blue': '#0066CC',
        'light-blue': '#E3F2FD',
        'primary-orange': '#FF9800',
        'light-bg': '#F5F5F5',
        'text-dark': '#333333',
        'text-light': '#666666',
      },
    },
  },
  plugins: [],
};
