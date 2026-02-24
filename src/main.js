// Vite Stuff
// Accept HMR as per: https://vitejs.dev/guide/api-hmr.html
if (import.meta.hot) {
	import.meta.hot.accept(() => {});
}
import TopNav from '../views/partials/top-nav';
import './style.css';
import.meta.glob('../views/**/*.css', { eager: true });

const topNav = document.querySelector('.top-nav');
if (topNav) {
	TopNav(topNav);
}
