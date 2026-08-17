import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/core/less/app.less',
                'resources/assets/core/less/colors/default.less',
                'resources/assets/core/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
