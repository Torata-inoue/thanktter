import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import laravel from 'laravel-vite-plugin';

// https://vitejs.dev/config/
// https://readouble.com/laravel/10.x/ja/vite.html
export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/ts/src/entries/app/index.tsx'],
      publicDirectory: 'htdocs',
      refresh: true,
    }),
    react(),
  ],
  server: {
    host: true,
    hmr: {
      host: 'localhost'
    },
    watch: {
      usePolling: true
    }
  },
});
