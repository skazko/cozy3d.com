(function() {
  const desktopMediaQuery = '(min-width: 1024px)';
  const portfolio = document.querySelector('.portfolio');
  if (!portfolio) {
    return;
  }

  const desktop = window.matchMedia(desktopMediaQuery);

  const items = portfolio.querySelectorAll('.portfolio__item');
  const list = portfolio.querySelector('.portfolio__list');

  const intersictionOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.01
  };

  const parallax = {
    desktop: function(elem, title) {
      const gap = (window.pageYOffset - elem.offsetTop) * 0.25;
      title.style.transform = 'translateY(' + gap + 'px)';
    },
    mobile: function(elem, title) {
      // const gap = (window.pageYOffset - elem.offsetTop) * 0.25;
      if (!elem.dataset.opacity) {
        elem.dataset.opacity = 0;
      }
      if (elem.dataset.opacity < 100) {
        elem.dataset.opacity = +elem.dataset.opacity + 10;
      }
    }
  }

  desktop.addListener(function(mql) {
    const items = portfolio.querySelectorAll('.portfolio__item');
    const handler = mql.matches ? parallax.desktop : parallax.mobile;

    if (!mql.matches) {
      items.forEach(item => {
        const title = item.querySelector('.project__title');
        title.style.transform = '';
      })
    }

    listeners.forEach(listener => {
      window.removeEventListener('scroll', listener);
    })

    items.forEach(item => {
      const title = item.querySelector('.project__title');
      listeners[item.dataset.position] = function() {
        window.requestAnimationFrame(function() {
          handler(item, title);
        });
      };
    });
  });


  function init(elem, listeners) {
    elem.dataset.position = listeners.length;
    const title = elem.querySelector('.project__title');
    const handler = desktop.matches ? parallax.desktop : parallax.mobile;

    listeners.push(function() {
      window.requestAnimationFrame(function () {
        handler(elem, title);        
      });
    });
  } 

  const listeners = [];

  const callback = function(entries, observer) {
    console.log('callback')
    entries.forEach(entry => {

      if (!entry.target.dataset.initialized) {
        init(entry.target, listeners);
        if (entry.isIntersecting) {
          listeners[entry.target.dataset.position]();
        }
      } 
      
      if (entry.isIntersecting) {
        window.addEventListener('scroll', listeners[entry.target.dataset.position]);
      } else {
        window.removeEventListener('scroll', listeners[entry.target.dataset.position]);
      }
    })
  };

  const observer = new IntersectionObserver(callback, intersictionOptions);

  for (let i = 0; i < items.length; i++) {
    observer.observe(items.item(i));
  }

  //mutation observer

  let mutationObserver = new MutationObserver(mutations => {
    mutations.forEach(mutation => {
      mutation.addedNodes.forEach(node => {
        if (Node.ELEMENT_NODE === node.nodeType && node.classList.contains('portfolio__item')) {
          init(node, listeners);
          observer.observe(node);
        }
      });
    });
  });

  mutationObserver.observe(list, {
    childList: true,
  });
})();