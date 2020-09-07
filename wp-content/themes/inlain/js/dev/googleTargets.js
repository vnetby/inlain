import { dom } from "vnet-dom";


let yaCounter;

let DEBUG;


export const googleTargets = (sets) => {

  yaCounter = sets.yaCounter;
  DEBUG = sets.debug || false;

  dom.document.addEventListener('DOMContentLoaded', e => {
    initForms();
  });
}




/**
 * - Отправка формы
 * 
 * - Передает событие: formsubmit
 * 
 */

const initForms = () => {
  dom.on('wpcf7mailsent', '.wpcf7', e => {
    let form = e.target.querySelector('form');
    let event;
    if (form.classList.contains('form-order-test')) {
      event = 'formsubmit';
    }
    if (form.classList.contains('form-order-consult')) {
      event = 'consultform';
    }
    ym(yaCounter, 'reachGoal', 'formsubmit');
    dataLayer.push({ event: 'formsubmit' });

    debugConsole(`Yandex: ${event}\r\nGoogle: ${event}`);
  });
}






/**
 * 
 * - Нажатие на социальные сети
 * 
 * - Передает событие: viberme|whatsappme|telegramme
 * 
 */

const initSocialClick = () => {
  dom.onClick('.gt-social', e => {
    let btn = e.currentTarget;
    let type = btn.dataset.gtType || 'social';
    yaCounter65474599.reachGoal(type + 'me');

    dataLayer.push({ event: `${type}me` });
    debugConsole(`Yandex: ${type}me\r\nGoogle: ${type}me`);
  });
}






/**
 * 
 * - Нажате на телефон
 * 
 * - Передает событие: phoneclick
 * 
 */

const initPhoneClick = () => {
  dom.onClick('.gt-phone', e => {
    let btn = e.currentTarget;
    if (btn.classList.contains('js-hidden-phone') && !btn.classList.contains('active')) {
      yaCounter65474599.reachGoal('phoneclick');
      dataLayer.push({ event: `phoneclick` });

      debugConsole(`Yandex: phoneclick\r\nGoogle: phoneclick`);
    }
  });
}






/**
 * 
 * - Нажатие на email
 * 
 * - Передает событие: mailme
 * 
 */

const initEmailClick = () => {
  dom.onClick('.gt-email', e => {
    yaCounter65474599.reachGoal('mailme');
    dataLayer.push({ event: `mailme` });
    console.log(`Yandex: mailme\r\nGoogle: mailme`);
  });
}







/**
 * - Копирование email
 * 
 * - Передает событие: mailcopy
 * 
 */

const initCopyText = () => {
  dom.on('copy', dom.body, e => {
    if (!e.target.classList.contains('gt-email')) return;
    let text = getSelectedText();
    if (e.target.classList.contains('gt-email')) {
      yaCounter65474599.reachGoal('mailcopy');
      dataLayer.push({ event: `mailcopy` });
      console.log(`Yandex: mailcopy\r\nGoogle: mailcopy`);
    }
  });
}









const getSelectedText = () => {
  let text = '';
  if (typeof dom.window.getSelection != 'undefined') {
    text = dom.window.getSelection().toString();
  } else if (typeof dom.document.selection != 'undefined' && dom.document.selection.type == 'Text') {
    text = dom.document.selection.createRange().text;
  }
  return text;
}





const debugConsole = (msg) => {
  if (!DEBUG) return;
  console.log(msg);
}