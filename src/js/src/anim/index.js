function clearSideEffects(elem, initial) {
  elem.outerHTML = initial[elem.dataset.position];
}

function clearScrollHandlers(handlers) {
  handlers.forEach(handler => window.removeEventListener('scroll', handler));
  handlers.length = 0;
}

function initItem(item, initial, handlers, createHandler) {
  initial.push(item.outerHTML);
  item.dataset.position = handlers.length;
  handlers.push(createHandler(item));
}

function startIntersectionObserver({ items, createHandler, handlers, initial }) {
  const defaultSettings = {
    root: null,
    rootMargin: '0px',
    threshold: 0.01
  };

  function callback(entries, observer) {
    entries.forEach(entry => {
      console.log(entry)
      if (!entry.target.dataset.position) {
        initItem(entry.target, initial, handlers, createHandler);
        
        // if (entry.isIntersecting) {
          handlers[entry.target.dataset.position]();
        // }
      } 
      
      if (entry.isIntersecting) {
        window.addEventListener('scroll', handlers[entry.target.dataset.position]);
      } else {
        window.removeEventListener('scroll', handlers[entry.target.dataset.position]);
      }
    })
  }
  const observer = new IntersectionObserver(callback, defaultSettings);

  for (let i = 0; i < items.length; i++) {
    observer.observe(items.item(i));
  }

  return observer;
}

export function anim(settings) {
  const {breakpoint, itemsClassName, listClassName, desktopHandler, mobileHandler} = settings;
  const handlers = [];
  const initial = [];
  const items = document.getElementsByClassName(itemsClassName);
  if ( items.length === 0 ) {
    return;
  }
  const breakpointMQ = window.matchMedia(breakpoint);

  let createHandler = breakpointMQ.matches ? desktopHandler : mobileHandler;
  let intersectionObserver
  if (createHandler) {
    intersectionObserver = startIntersectionObserver({ createHandler, items, handlers, initial });
  } 

  breakpointMQ.addListener(function(mql) {
    for (let i = 0; i < items.length; i++) {
      clearSideEffects(items[i], initial)
    }
    clearScrollHandlers(handlers);
    initial.length = 0;
    createHandler = mql.matches ? desktopHandler : mobileHandler;
    intersectionObserver = startIntersectionObserver({ createHandler, items, handlers, initial})
  });

  const list = document.querySelector('.' + listClassName);
  if (list) {
    let mutationObserver = new MutationObserver(mutations => {
      mutations.forEach(mutation => {
        mutation.addedNodes.forEach(node => {
          if (Node.ELEMENT_NODE === node.nodeType && node.classList.contains(itemsClassName)) {
            initItem(node, initial, handlers, createHandler);
            intersectionObserver.observe(node);
          }
        });
      });
    });
  
    mutationObserver.observe(list, {
      childList: true,
    });
  }
}
