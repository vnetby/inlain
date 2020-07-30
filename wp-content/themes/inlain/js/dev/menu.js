import { dom } from "vnet-dom";



export const menu = () => {
  dom.onClick('.menu a', e => {
    e.preventDefault();

    let btn = e.currentTarget;

    let id = btn.getAttribute('href');

    let block = dom.findFirst(id);

    if (!block) return;

    let top = block.getBoundingClientRect().top + dom.window.pageYOffset;

    dom.window.scrollTo(0, top);

    dom.removeClass(dom.body, 'mobile-menu-is-open');

  });

  initMobileMenu();
}









const initMobileMenu = () => {
  dom.onClick('.js-open-mobile-menu', e => {
    e.preventDefault();
    dom.toggleClass(dom.body, 'mobile-menu-is-open');
  });
}