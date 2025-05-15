import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#11999E',
                    1: '#0D7A7E',
                    2: '#0A5B5E',
                    3: '#F5F7F8',
                },
                info: '#666666',
                'info-1': '#E5E5E5',
            },
            borderRadius: {
                'std': '0.5rem',
                'std-1/2': '0.25rem',
            },
        },
        screens: {
            sm: '850px',
            md: '1200px',
            lg: '1280px',
            xl: '1440px',
            '2xl': '1600px',
        },
    },

    plugins: [forms],
};
