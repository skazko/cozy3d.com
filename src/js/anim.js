import { scroller } from './src/anim/index';

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
    const even = item.dataset.position % 2 === 0;

    function translateTitle(y) {
      const dymax = 200;
      const dymin = -100;
      const dxmax = even ? 50 : -50;
      let dy, dx;
      if (y < startY) {
        dy = dymin;
        dx = 0;
      } else if (y > endY) {
        dy = dymax;
        dx = 0;
      } else {
        const change = (y - startY) / length;
        dy = change * (dymax - dymin) + dymin;
        dx = dxmax * Math.sin(change * Math.PI);
      }

      return `translate(${dx}px, ${dy}px)`
    }
    return function() {
      window.requestAnimationFrame(function() {
        title.style.transform = translateTitle(pageYOffset);
      })
    }
  }

  scroller.init({
    breakpoint: '(min-width: 1024px)',
    itemClassName: 'portfolio__item',
    containerClassName: 'portfolio__list',
    createHandler
  })

})();