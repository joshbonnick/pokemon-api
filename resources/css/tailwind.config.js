const defaultTheme = require('tailwindcss/defaultTheme')

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.{vue,js,ts}',
    ],
    //
    theme: {
        extend: {
            fontFamily: {
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
                poetsen: ['Poetsen One', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'red': {
                    DEFAULT: '#f00',
                    50: '#ffb8b8',
                    100: '#ffa3a3',
                    200: '#ff7a7a',
                    300: '#ff5252',
                    400: '#ff2929',
                    500: '#f00',
                    600: '#c70000',
                    700: '#8f0000',
                    800: '#570000',
                    900: '#1f0000',
                    950: '#030000'
                },
            }
        },
    },
}
