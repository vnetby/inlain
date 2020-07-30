import { dom } from "vnet-dom";


export const classOnView = () => {
  dom.window.addEventListener('load', e => {
    checkView();
  })
  dom.onWindowScroll(e => {
    checkView();
  });
}






const checkView = () => {
  let items = getItems();
  if (!items) return;

  items.forEach(item => {
    if (!dom.isInViewport(item)) return;
    dom.addClass(item, 'in-viewport');
  });
}






const getItems = () => {
  let items = dom.findAll('.js-clss-on-view');
  if (!items) return false;
  items = items.filter(item => !item.classList.contains('in-viewport'));
  if (!items || !items.length) return false;
  return items;
}