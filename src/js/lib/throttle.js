export function throttle(event, optimizedEvent, obj) {
  obj = obj || window;
  let running = false;
  const optimizedHandler = function() {
    if (!running) { 
      running = true;
      requestAnimationFrame(function() {
        obj.dispatchEvent(new CustomEvent(optimizedEvent));
        running = false;
      });
    }
  };
  obj.addEventListener(event, optimizedHandler);
};
