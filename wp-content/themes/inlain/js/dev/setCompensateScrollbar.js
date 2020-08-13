import { dom } from "vnet-dom";



export const setCompensateScrollbar = () => {
  let style = dom.create('style');

  style.innerHTML = `
    body.compensate-for-scrollbar .header .btn-col {
      padding-right: ${dom.scrollBarWidth}px;
    }
    body.compensate-for-scrollbar #wpadminbar {
      padding-right: ${dom.scrollBarWidth}px;
    }
  `;

  dom.document.head.appendChild(style);
}