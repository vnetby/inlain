import { dom } from "vnet-dom";

const COUNT_SCROLL = 10;




export const setScrollDirection = () => {
  let scroll = dom.window.pageYOffset;
  let countScroll = 0;

  dom.onWindowScroll(e => {
    let newScroll = dom.window.pageYOffset;
    if (countScroll < COUNT_SCROLL) {
      countScroll++;
      return;
    }
    if (newScroll > scroll) {
      dom.addClass(dom.body, 'scroll-down');
      dom.removeClass(dom.body, 'scroll-up');
    }
    if (newScroll < scroll) {
      dom.addClass(dom.body, 'scroll-up');
      dom.removeClass(dom.body, 'scroll-down');
    }
    scroll = newScroll;
    countScroll = 0;
  });
}