import { dom } from "vnet-dom";



export const accordion = container => {
  let items = dom.findAll('.js-accordion', container);
  if (!items) return;

  items.forEach(item => {
    initAccordion(item);
  });
}






const initAccordion = accordion => {
  let items = dom.findAll('.accordion-item', accordion);
  if (!items) return;

  let bodies = dom.findAll('.accordion-body', accordion);
  if (!bodies) return;

  items.forEach(item => {
    dom.onClick('.accordion-head', e => {
      if (item.classList.contains('active')) return;
      let body = dom.findFirst('.accordion-body', item);
      hideBodies(bodies, body);
      showBody(body);
      dom.removeClass(items, 'active');
      dom.addClass(item, 'active');
    }, item);
  });
}




const hideBodies = (bodies, body) => {
  bodies.forEach(current => {
    if (current === body) return;
    $(current).slideUp({ duration: 200 });
  });
}




const showBody = (body) => {
  $(body).slideDown({ duration: 200 });
}