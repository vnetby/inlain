import { dom } from "vnet-dom";





export const focusParent = (container) => {
  dom.on('focus', '.input', e => {
    let input = e.currentTarget;
    let parent = input.parentNode;
    if (parent && parent.tagName) {
      dom.addClass(parent, 'has-focus');
    }
  }, container);
  dom.on('blur', '.input', e => {
    let input = e.currentTarget;
    let parent = input.parentNode;
    if (parent && parent.tagName) {
      dom.removeClass(parent, 'has-focus');
    }
  }, container);
}