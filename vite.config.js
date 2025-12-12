import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  build: {
    outDir: 'public/vendor/vista',
    emptyOutDir: true,
    manifest: true,
    manifestFileName: 'manifest.json', // 👈 force root-level manifest
    rollupOptions: {
      input: 'resources/js/dashboard/app.js'
    }
  },
  publicDir: false
})
