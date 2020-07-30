import "../../css/dev/index.scss";

import { dom } from "vnet-dom";



// CUSTOM SCRIPTS
import { youtubeVideo } from "./youtubeVideo";
import { staticFormFunctions } from "./forms";
import { dynamicFormFunctions } from "./forms";
import { accordion } from "./accordion";
import { menu } from "./menu";
import { setScrollDirection } from "./setScrollDirection";
import { AOS } from "./AOS";
import { classOnView } from "./classOnView";
import { setCompensateScrollbar } from "./setCompensateScrollbar";





export const dynamicFunctions = wrap => {
  let container = dom.getContainer(wrap);
  if (!container) return;

  youtubeVideo(container);
  dynamicFormFunctions(container);
  accordion(container);
}






const staticFunctions = () => {
  staticFormFunctions();
  menu();
  setScrollDirection();
  AOS();
  classOnView();
  setCompensateScrollbar();
}




dynamicFunctions();
staticFunctions();