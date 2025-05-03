import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import tailwindScrollbar from 'tailwind-scrollbar';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Lato', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, tailwindScrollbar({ nocompatible: true })],
};
