import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
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
