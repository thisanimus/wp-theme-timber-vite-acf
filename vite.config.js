import ViteRestart from 'vite-plugin-restart';
import { defineConfig } from 'vite';
import mkcert from 'vite-plugin-mkcert';
import path from 'path';
import 'dotenv/config';

export default defineConfig(({ command }) => {
	return {
		base: command === 'serve' ? '/' : `/${process.env.VITE_OUTPUT_DIR}/`,
		build: {
			manifest: true,
			outDir: process.env.VITE_OUTPUT_DIR,
			rollupOptions: {
				input: {
					app: process.env.VITE_ENTRY_POINT,
				},
			},
		},
		css: {
			preprocessorOptions: {
				scss: {
					additionalData: `@use '@/base/functions.scss' as *;`,
					api: 'modern-compiler',
				},
			},
		},
		plugins: [
			mkcert(),
			ViteRestart({
				reload: ['/**/*.html', '/**/*.twig', '/**/*.php', '!vendor/**/*', '!node_modules/**/*'],
			}),
		],
		resolve: {
			alias: {
				'@': path.resolve(__dirname, 'src'),
			},
		},
		server: {
			https: process.env.VITE_PROTOCOL === 'https',
			cors: true,
			fs: {
				strict: false,
			},
			origin: `http://${process.env.VITE_HOST}:${process.env.VITE_PORT}`,
			port: parseInt(process.env.VITE_PORT),
			strictPort: true,
			hmr: {
				host: process.env.VITE_HOST,
			},
		},
	};
});
