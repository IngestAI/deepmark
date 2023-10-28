import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import dotenv from 'dotenv'

dotenv.config()
export default defineConfig({
    define: {
      __BEARER_TOKEN__: `"${process.env.BEARER_TOKEN}"` // wrapping in "" since it's a string
    },
    plugins: [
        laravel({
            input: [
                'resources/css/theme.scss',
                'resources/js/index.jsx',
            ],
            refresh: true,
        }),
        react(),
    ],
    resolve: {
      alias: {
        '_components': '/resources/js/components',
        '_api': '/resources/js/api',
        '_models': '/resources/js/models',
      },
    },
});
