/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	let container, button, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		console.log('button not finded')
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'main-navigation__menu' ) ) {
		menu.classList.add('main-navigation__menu');
	}

	document.addEventListener('closeMobileMenu', () => {
		console.log('close mobile menu');
	})

	document.addEventListener('openMobileMenu', () => {
		console.log('open mobile menu');
	})

	const mobile = window.matchMedia('(min-width: 640px)');
	function closeMenuHandler(mql) {
		if (document.body.dataset.mobileMenuIsOpened && mql.matches) {
			console.log('close menu handler')
			delete document.body.dataset.mobileMenuIsOpened;
			container.classList.remove('toggled');
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
			menu.classList.remove('main-navigation__menu_open');
		}
	}

	mobile.addListener(closeMenuHandler)

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			document.dispatchEvent(new CustomEvent('closeMobileMenu'));
			delete document.body.dataset.mobileMenuIsOpened;
			container.classList.remove('toggled');
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
			menu.classList.add('main-navigation__menu_animate');
			menu.classList.remove('main-navigation__menu_open');
			animation = setTimeout(() => {
				menu.classList.remove('main-navigation__menu_animate');
			},300)
		} else {
			document.dispatchEvent(new CustomEvent('openMobileMenu'));
			window.scrollTo(0, 0);
			document.body.dataset.mobileMenuIsOpened = true;
			container.classList.add('toggled');
			menu.classList.add('main-navigation__menu_animate');
			menu.classList.add('main-navigation__menu_open');
			animation = setTimeout(() => {
				menu.classList.remove('main-navigation__menu_animate');
			},300)
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};



	// // Get all the link elements within the menu.
	// links    = menu.getElementsByTagName( 'a' );

	// // Each time a menu link is focused or blurred, toggle focus.
	// for ( i = 0, len = links.length; i < len; i++ ) {
	// 	links[i].addEventListener( 'focus', toggleFocus, true );
	// 	links[i].addEventListener( 'blur', toggleFocus, true );
	// }

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
		// ( function( container ) {
		// 	var touchStartFn, i,
		// 		parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		// 	if ( 'ontouchstart' in window ) {
		// 		touchStartFn = function( e ) {
		// 			var menuItem = this.parentNode, i;

		// 			if ( ! menuItem.classList.contains( 'focus' ) ) {
		// 				e.preventDefault();
		// 				for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
		// 					if ( menuItem === menuItem.parentNode.children[i] ) {
		// 						continue;
		// 					}
		// 					menuItem.parentNode.children[i].classList.remove( 'focus' );
		// 				}
		// 				menuItem.classList.add( 'focus' );
		// 			} else {
		// 				menuItem.classList.remove( 'focus' );
		// 			}
		// 		};

		// 		for ( i = 0; i < parentLink.length; ++i ) {
		// 			parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
		// 		}
		// 	}
		// }( container ) );
} )();
