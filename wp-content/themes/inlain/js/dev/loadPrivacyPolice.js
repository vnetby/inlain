import { dom } from "vnet-dom";




export const loadPrivacyPolice = container => {
  dom.onClick('.js-load-privacy-police', e => {
    e.preventDefault();
    dom.addClass(dom.body, 'loading');
    getModal().then(html => {
      showModal(html);
      dom.removeClass(dom.body, 'loading');
    });
  }, container);
}





const getModal = () => {
  return new Promise((resolve, reject) => {
    dom.ajax({
      url: `${back_dates.ajax_url}?action=get_privacy_police_modal`
    }).then(res => resolve(res));
  });
}





const showModal = html => {
  $.fancybox.close();
  let div = dom.create('div', { innerHTML: html });
  let modal = dom.findFirst('.modal', div);

  $.fancybox.open(modal, { touch: false });
}