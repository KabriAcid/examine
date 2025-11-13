import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        middlewareMode: false,
        cors: {
            origin: "*",
            methods: [
                "GET",
                "HEAD",
                "PUT",
                "POST",
                "DELETE",
                "PATCH",
                "OPTIONS",
            ],
            credentials: true,
        },
        hmr: {
            host: "localhost",
            port: 5173,
            protocol: "http",
        },
    },
});
