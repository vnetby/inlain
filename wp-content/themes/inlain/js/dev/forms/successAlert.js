import { dom } from "vnet-dom";

import { React } from "vnet-dom/DOM/domReact";



export const successAlert = () => {
  dom.body.addEventListener('wpcf7mailsent', e => {
    let msg = e.detail.apiResponse.message;
    displayAlertModal(msg);
  });
}





const displayAlertModal = msg => {
  $.fancybox.close();
  let modal = createAlertModal(msg);
  $.fancybox.open(modal);
}






const createAlertModal = (msg) => {
  let modal = (<div className="alert-modal"></div>);
  modal.innerHTML = msg;
  return modal;
}