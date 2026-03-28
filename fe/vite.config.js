import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import path from 'path'

// Build output goes into the WordPress plugin folder so the plugin can enqueue
// the compiled assets directly.
export default defineConfig({
  plugins: [react()],
  build: {
    outDir: path.resolve(__dirname, '../plugin/assets'),
    emptyOutDir: true,
    rollupOptions: {
      input: path.resolve(__dirname, 'src/main.jsx'),
      output: {
        // Deterministic file names so the PHP plugin can hard-code them
        entryFileNames: 'loi-chua.js',
        chunkFileNames: 'loi-chua-[name].js',
        assetFileNames: (assetInfo) => {
          const name = assetInfo.names?.[0] ?? assetInfo.name ?? ''
          if (name.endsWith('.css')) {
            return 'loi-chua.css'
          }
          return name || '[name][extname]'
        },
      },
    },
  },
})

