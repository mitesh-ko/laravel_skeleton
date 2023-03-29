import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/assets/demo.css',
                'resources/css/assets/profile.css',
                'resources/css/assets/login.css',
                //--- js ---
                'resources/js/app.js',
                'resources/js/assets/account.js',
                'resources/js/assets/profile.js',
                'resources/js/assets/main.js',
                'resources/js/assets/index-user.js',
                'resources/js/assets/index-role.js',
                'resources/js/assets/create-update-role.js',
                'resources/js/assets/login.js',
                'resources/js/assets/toaster.js',
                'resources/js/assets/update-email-template.js',
                'resources/js/assets/index-transaction.js'
            ],
        }),
    ],
});
