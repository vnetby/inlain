import { dom } from "vnet-dom";




export const typePhone = container => {
  return;
  let inputs = dom.findAll('.custom-phone', container);
  if (!inputs) return;

  inputs.forEach(input => initCustomPhone(input));
}





const initCustomPhone = input => {
  let iti = dom.window.intlTelInput(input, {
    initialCountry: 'ru',
    autoPlaceholder: 'aggressive',
    nationalMode: false,
    preferredCountries: ['ru', 'by'],
    customPlaceholder: (placeholder, data) => {
      let iso = data.iso2;
      if (iso === 'ru') {
        return '+7';
      }
      if (iso === 'by') {
        return '+375';
      }
      return placeholder;
    },
    utilsScript: `${back_dates.SRC}js/telUtils.js`
  });
  input.addEventListener('focus', e => {
    if (input.value) return;
    let data = iti.getSelectedCountryData();
    iti.setNumber(`+${data.dialCode}`);
  });
  input.addEventListener("countrychange", e => {
    let data = iti.getSelectedCountryData();
    iti.setNumber(`+${data.dialCode}`);
  });
}