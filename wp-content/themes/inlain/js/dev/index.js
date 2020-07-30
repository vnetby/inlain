import "../../css/dev/index.scss";

import { dom } from "vnet-dom";



// CUSTOM SCRIPTS
import { youtubeVideo } from "./youtubeVideo";
import { staticFormFunctions } from "./forms";
import { dynamicFormFunctions } from "./forms";
import { accordion } from "./accordion";





export const dynamicFunctions = wrap => {
  let container = dom.getContainer(wrap);
  if (!container) return;

  youtubeVideo(container);
  dynamicFormFunctions(container);
  accordion(container);
}






const staticFunctions = () => {
  staticFormFunctions();
}




dynamicFunctions();
staticFunctions();