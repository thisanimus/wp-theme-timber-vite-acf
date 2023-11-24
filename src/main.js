// Vite Stuff
// Accept HMR as per: https://vitejs.dev/guide/api-hmr.html
if (import.meta.hot) {
	import.meta.hot.accept(() => {
		console.log('HMR');
	});
}

// SCSS
import '../src/main.scss';

// glob import all scss files
import.meta.glob('../templates/**/*.scss', { eager: true });

// component imports
import Menu from '../templates/components/menu/menu';

const menu = document.querySelector('nav.menu');
if (menu) {
	console.log(menu);
	new Menu(menu);
}
