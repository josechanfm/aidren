export function applyPassiveEventListeners() {
  const originalAddEventListener = EventTarget.prototype.addEventListener;
  EventTarget.prototype.addEventListener = function(type, listener, options) {
    let targetOptions = options;
    if (type === 'touchstart' || type === 'touchmove') {
      if (typeof options === 'boolean') {
        targetOptions = { capture: options, passive: true };
      } else if (typeof options === 'object') {
        targetOptions = { ...options, passive: true };
      } else {
        targetOptions = { passive: true };
      }
    }
    return originalAddEventListener.call(this, type, listener, targetOptions);
  };
}
