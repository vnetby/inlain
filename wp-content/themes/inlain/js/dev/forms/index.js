import { dom } from "vnet-dom";

import { focusParent } from "./focusParent";
import { typePhone } from "./typePhone";
import { successAlert } from "./successAlert";



export const dynamicFormFunctions = container => {
  focusParent(container);
  typePhone(container);
}


export const staticFormFunctions = () => {
  successAlert();
}