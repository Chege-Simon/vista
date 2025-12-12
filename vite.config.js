import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  build: {
    outDir: 'public/vendor/vista',   // compiled assets
    emptyOutDir: true,
    rollupOptions: {
      input: 'resources/js/dashboard/app.js'
    }
  },
  publicDir: false // disable copying public/ into outDir
})
