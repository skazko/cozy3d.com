import {anim} from './src/anim/index';

(function() {
  function mobileHandler(item) {
    const title = item.querySelector('.project__title');
    return function() {
      window.requestAnimationFrame(function() {
        item.dataset.mobile = window.pageYOffset;
      })
    }
  }

  function desktopHandler(item) {
    const title = item.querySelector('.project__title');
    return function() {
      window.requestAnimationFrame(function() {
        item.dataset.desktop = window.pageYOffset;
      })
    }
  }

  anim({
    breakpoint: '(min-width: 1024px)',
    itemsClassName: 'portfolio__item',
    listClassName: 'portfolio__list',
    mobileHandler,
    desktopHandler
  });
})();