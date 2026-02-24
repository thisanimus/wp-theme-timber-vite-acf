import ViteRestart from 'vite-plugin-restart';
import { defineConfig, loadEnv } from 'vite';
import mkcert from 'vite-plugin-mkcert';
import path from 'path';

export default defineConfig(({ command, mode }) => {
	const env = loadEnv(mode, process.cwd());

	return {
		base: command === 'serve' ? '/' : `/${env.VITE_OUTPUT_DIR}/`,
		build: {
			manifest: true,
			outDir: env.VITE_OUTPUT_DIR,
			rolldownOptions: {
				input: {
					app: env.VITE_ENTRY_POINT,
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
			https: env.VITE_PROTOCOL === 'https',
			cors: true,
			fs: {
				strict: false,
			},
			origin: `http://${env.VITE_HOST}:${env.VITE_PORT}`,
			port: parseInt(env.VITE_PORT),
			strictPort: true,
			hmr: {
				host: env.VITE_HOST,
			},
		},
	};
});
