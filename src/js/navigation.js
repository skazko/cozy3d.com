/**
 * Handles toggling the navigation menu for small screens
 */

( function() {
	let container, button, menu, site;
	let animation = false;
	const buttonMediaQuery = '(min-width: 640px)';

	container = document.getElementById( 'site-navigation' );
	if ( !container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'main-navigation__menu' ) ) {
		menu.classList.add('main-navigation__menu');
	}

	site = document.querySelector('.site') || document.body;

	function closeMenu(animation) {
		if (animation) {
			return;
		}

		button.setAttribute( 'aria-expanded', 'false' );
		menu.setAttribute( 'aria-expanded', 'false' );
		container.classList.remove('toggled');
		menu.classList.add('main-navigation__menu_animate');
		animation = true;
		menu.classList.remove('main-navigation__menu_open');
		delete site.dataset.mobileMenuIsOpened;

		setTimeout(() => {
			menu.classList.remove('main-navigation__menu_animate');
			animation = false;
		},400);
	}

	function openMenu(animation) {
		if (animation) {
			return;
		}

		window.scrollTo(0, 0);
		button.setAttribute( 'aria-expanded', 'true' );
		menu.setAttribute( 'aria-expanded', 'true' );
		container.classList.add('toggled');
		menu.classList.add('main-navigation__menu_animate');
		animation = true;
		menu.classList.add('main-navigation__menu_open');
		site.dataset.mobileMenuIsOpened = true;

		setTimeout(() => {
			menu.classList.remove('main-navigation__menu_animate');
			animation = false;
		},400)
	}

	document.addEventListener('closeMobileMenu', () => {
		closeMenu(animation);
	});

	document.addEventListener('openMobileMenu', () => {
		openMenu(animation);
	});

	button.addEventListener('click', function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			document.dispatchEvent(new CustomEvent('closeMobileMenu'));
		} else {
			document.dispatchEvent(new CustomEvent('openMobileMenu'));
		}
	});

	// Closing menu in case mobile rotated and button close
	// button hided
	const mobile = window.matchMedia(buttonMediaQuery);
	mobile.addListener(mql => {
		if (site.dataset.mobileMenuIsOpened && mql.matches) {
			closeMenu(animation);
		}
	});
} )();
