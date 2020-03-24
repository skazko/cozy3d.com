import { throttle } from './throttle';

function _init(settings) {
  const {breakpoint, itemClassName, containerClassName, createHandler, intersectionSettings} = settings;
  
  const defaultIntersectionSettings = {
    root: null,
    rootMargin: '0px',
    threshold: 0.01
  };

  const container = document.querySelector('.' + containerClassName) || document.body;
  if (container === null) {
    return;
  }

  const items = container.getElementsByClassName(itemClassName);
  if ( items.length === 0 ) {
    return;
  }
  const mediaQuery = window.matchMedia(breakpoint);

  return {
    itemClassName,
    items,
    container,
    mediaQuery,
    createHandler,
    handlers: [],
    initialItems: [],
    intersectionSettings: Object.assign({}, defaultIntersectionSettings, intersectionSettings)
  }
}

export const scroller = {
  init(options) {
    this.state = _init(options);
    this.recalc = this.recalc.bind(this);
    this.handleMediaQuery(this.state.mediaQuery);
    this.state.mediaQuery.addListener(this.handleMediaQuery.bind(this));
  },

  start() {
    if (this.state.isStarted) {
      return;
    }

    this.state.isStarted = true;
    throttle('resize', 'optimizedResize');
    this.initItems();
    this.createIntersectionObserver();
    this.startIntersectionObserver();
    this.createMutationObserver();
    this.startMutationObserver();
    window.addEventListener('optimizedResize', this.recalc);
  },

  stop() {
    if (!this.state.isStarted) {
      return;
    }
    window.removeEventListener('optimizedResize', this.recalc);
    this.clearScrollHandlers();
    this.clearSideEffects();
    this.state.intersectionObserver.disconnect();
    this.state.mutationObserver.disconnect();
    this.state.isStarted = false;
  },

  initItem(item) {
    const { handlers, initialItems, createHandler } = this.state;
    const i = handlers.length;
    item.dataset.position = i;
    initialItems.push(item.outerHTML);
    handlers.push(createHandler(item));
    handlers[i]();
  },

  initItems() {
    const { items } = this.state;
    for (let i = 0; i < items.length; i++) {
      this.initItem(items[i]);
    }
  },

  createIntersectionObserver() {
    const { handlers, intersectionSettings } = this.state;
    const callback = (entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          window.addEventListener('scroll', handlers[entry.target.dataset.position]);
        } else {
          window.removeEventListener('scroll', handlers[entry.target.dataset.position]);
        }
      });
    }
    this.state.intersectionObserver = new IntersectionObserver(callback, intersectionSettings);
  },

  startIntersectionObserver() {
    const { items, intersectionObserver } = this.state;
    for (let i = 0; i < items.length; i++) {
      intersectionObserver.observe(items[i]);
    }
  },

  createMutationObserver() {
    const { itemClassName, intersectionObserver } = this.state;

    this.state.mutationObserver = new MutationObserver(mutations => {
      mutations.forEach(mutation => {
        mutation.addedNodes.forEach(node => {
          const isNotInitedItem = Node.ELEMENT_NODE === node.nodeType 
            && node.classList.contains(itemClassName)
            && !node.dataset.position;

          if (isNotInitedItem) {
            this.initItem(node);
            intersectionObserver.observe(node);

            function imageLoaded() {
              count++;
              if (count >= images.length) {
                this.recalc();
              }
            }

            let images = node.querySelectorAll('img');
            let count = 0;
            for (let i = 0; i < images.length; i++) {
              images[i].addEventListener('load', imageLoaded.bind(this))
            }
            
          }
        });
      });
    });
  },

  startMutationObserver() {
    this.state.mutationObserver.observe(this.state.container, {
      childList: true,
    });
  },

  recalc() {
    const { items, handlers, createHandler, intersectionObserver } = this.state;
    intersectionObserver.disconnect();
    this.clearScrollHandlers();
    for (let i = 0; i < items.length; i++) {
      const item = items[i];
      const j = item.dataset.position;
      handlers[j] = createHandler(item);
      handlers[j]();
    }
    this.startIntersectionObserver();
  },

  handleMediaQuery(mql) {
    if (mql.matches) {
      this.start();
    } else {
      this.stop();
    }
  },

  clearSideEffects() {
    const { initialItems, items, handlers } = this.state;
    for (let i = 0; i < items.length; i++) {
      const item = items[i];
      item.outerHTML = initialItems[item.dataset.position];
    }
    handlers.length = 0;
    initialItems.length = 0;
  },

  clearScrollHandlers() {
    for (let i = 0; i < this.state.handlers.length; i++) {
      window.removeEventListener('scroll', this.state.handlers[i]);
    }
  }
}
