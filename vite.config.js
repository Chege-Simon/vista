import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [vue()],
  build: {
    rollupOptions: {
      input: 'resources/js/dashboard/app.js', // <-- must match actual file
      output: {
        dir: 'public/vendor/vista',
        entryFileNames: 'app.js',
        assetFileNames: 'assets/[name].[ext]'
      }
    }
  }
});
