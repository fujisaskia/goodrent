import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            keyframes: {
                smallbounce: {
                  '0%, 100%': { transform: 'translateY(-10px)' }, // Membatasi tinggi bounce
                  '50%': { transform: 'translateY(0)' },
                },
            },
            animation: {
                smallbounce: 'smallbounce 4s infinite', // Mengatur durasi animasi
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            scrollBehavior: {
                smooth: 'smooth',
            },
        },
    },
    plugins: [],
};
