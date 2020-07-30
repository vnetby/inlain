import { dom } from "vnet-dom";

import { focusParent } from "./focusParent";
import { typePhone } from "./typePhone";




export const dynamicFormFunctions = container => {
  focusParent(container);
  typePhone(container);
}


export const staticFormFunctions = () => {

}