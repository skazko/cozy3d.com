import { scroller } from './lib/scroller';

(function() {
  function createHandler(item) {
    const box = item.getBoundingClientRect();
    const gap = box.height * 0.05; // 5% задержка
    const top = box.top + pageYOffset;
    const bottom = box.bottom + pageYOffset;
    const H = document.documentElement.clientHeight;
    const startY = top - H + gap;
    const endY = bottom - gap;
    const length = endY - startY;
    const title = item.querySelector('.project__title');

    function translateTitle(y) {
      const dymax = 200;
      const dymin = -100;
      let dy;
      if (y < startY) {
        dy = dymin;
      } else if (y > endY) {
        dy = dymax;
      } else {
        const change = (y - startY) / length;
        dy = change * (dymax - dymin) + dymin;
      }

      return `translateY(${dy}px)`;
    }

    return function() {
      window.requestAnimationFrame(function() {
        title.style.transform = translateTitle(pageYOffset);
      });
    }
  }

  scroller.init({
    breakpoint: '(min-width: 1024px)',
    itemClassName: 'portfolio__item',
    containerClassName: 'portfolio__list',
    createHandler
  });

})();