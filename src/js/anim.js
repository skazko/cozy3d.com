import {anim} from './src/anim/index';

(function() {
  function mobileHandler(item) {
    const y = item.getBoundingClientRect().top + window.pageYOffset;
    const height = document.documentElement.clientHeight;
    const ymin = y - height;
    const ymax = y + item.offsetHeight;
    const gradient = height * 0.2;
    const scale = {min: 0.8, max: 1}

    return function() {
      window.requestAnimationFrame(function() {
        let percent;
        const wy = window.pageYOffset;

        if (wy < ymin || wy > ymax) {
          percent = 0;
        } else if (wy > ymin + gradient && wy < ymax - gradient) {
          percent = 1;
        } else if (wy > ymin && wy < ymin + gradient) {
          percent = (wy - ymin) / gradient;
        } else if (wy > ymax - gradient && wy < ymax) {
          percent = (ymax - wy) / gradient;
        }
        const res = percent * (scale.max - scale.min) + scale.min;
        console.log(res)
        item.style.transform = `scale(${res})`;
      })
    }
  }

  function desktopHandler(item) {
    const title = item.querySelector('.project__title');
    return function() {
      window.requestAnimationFrame(function() {
        const dy = (window.pageYOffset - item.offsetTop) * 0.25;
        title.style.transform = `translateY(${dy}px)`;
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