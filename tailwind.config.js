import { heroui } from '@heroui/react';
import typography from '@tailwindcss/typography';
import defaultTheme from 'tailwindcss/defaultTheme';

const herouiPlugin = heroui({
    themes: {
        light: {
            colors: {
                primary: {
                    DEFAULT: '#FD4254',
                    900: '#400107',
                    800: '#7f010e',
                    700: '#bf0215',
                    600: '#fc051d',
                    500: '#fd4254',
                    400: '#fd6a78',
                    300: '#fe8f9a',
                    200: '#feb4bc',
                    100: '#ffdadd',
                },
                secondary: {
                    DEFAULT: '#215c9f',
                    900: '#102e50',
                    800: '#215c9f',
                    700: '#468bd9',
                    600: '#96bde9',
                    500: '#e7f0fa',
                    400: '#ebf2fb',
                    300: '#f0f5fc',
                    200: '#f5f9fd',
                    100: '#fafcfe',
                },
                danger: {
                    DEFAULT: '#d0294a',
                    900: '#340a13',
                    800: '#681525',
                    700: '#9c1f38',
                    600: '#d0294a',
                    500: '#de5a74',
                    400: '#e57a8f',
                    300: '#eb9bab',
                    200: '#f2bdc7',
                    100: '#f8dee3',
                },
                filament: {
                    50: '#FFF6EB',
                    100: '#FFEFDC',
                    200: '#FEDFB8',
                    300: '#FECF95',
                    400: '#FDBC6D',
                    500: '#FDAE4B',
                    600: '#FC8E08',
                    700: '#C56D02',
                    800: '#834901',
                    900: '#422401',
                    950: '#1E1100',
                },
            },
        },
    },
});

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './node_modules/@heroui/theme/dist/**/*.{js,ts,jsx,tsx}',

        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.tsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'columbia-blue': {
                    DEFAULT: '#CBDCEE',
                    900: '#152b42',
                    800: '#2b5684',
                    700: '#4581c3',
                    600: '#87aed8',
                    500: '#cbdcee',
                    400: '#d4e2f1',
                    300: '#dfe9f5',
                    200: '#e9f0f8',
                    100: '#f4f8fc',
                },
                'tyrian-purple': {
                    DEFAULT: '#53193C',
                    900: '#10050c',
                    800: '#210a18',
                    700: '#310f24',
                    600: '#42142f',
                    500: '#53193c',
                    400: '#912b68',
                    300: '#c74593',
                    200: '#da83b7',
                    100: '#ecc1db',
                },
                blush: {
                    DEFAULT: '#DE5A74',
                    900: '#340a13',
                    800: '#681525',
                    700: '#9c1f38',
                    600: '#d0294a',
                    500: '#de5a74',
                    400: '#e57a8f',
                    300: '#eb9bab',
                    200: '#f2bdc7',
                    100: '#f8dee3',
                },
                folly: {
                    DEFAULT: '#FD4254',
                    900: '#400107',
                    800: '#7f010e',
                    700: '#bf0215',
                    600: '#fc051d',
                    500: '#fd4254',
                    400: '#fd6a78',
                    300: '#fe8f9a',
                    200: '#feb4bc',
                    100: '#ffdadd',
                },
                'delft-blue': {
                    DEFAULT: '#303B55',
                    900: '#0a0c11',
                    800: '#131822',
                    700: '#1d2333',
                    600: '#262f44',
                    500: '#303b55',
                    400: '#4b5c85',
                    300: '#6e81ad',
                    200: '#9eabc9',
                    100: '#cfd5e4',
                },
                'alice-blue': {
                    DEFAULT: '#E7F0FA',
                    900: '#102e50',
                    800: '#215c9f',
                    700: '#468bd9',
                    600: '#96bde9',
                    500: '#e7f0fa',
                    400: '#ebf2fb',
                    300: '#f0f5fc',
                    200: '#f5f9fd',
                    100: '#fafcfe',
                },
            },
        },
    },

    darkMode: 'class',
    plugins: [herouiPlugin, typography, require('tailwindcss-motion')],
};
