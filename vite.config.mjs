import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin'; // Assurez-vous que cette ligne est correcte

export default defineConfig({
    plugins: [
        laravel({ // Utilisez les parenthèses ici car laravel est une fonction
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
