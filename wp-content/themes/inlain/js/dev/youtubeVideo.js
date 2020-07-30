import { dom } from "vnet-dom";

const YOUTUBE_API = 'https://www.youtube.com/iframe_api';



export const youtubeVideo = (container) => {
  loadYoutubeApi().then(() => {
    dom.onClick('.js-video-play', e => {
      let target = e.currentTarget;
      initPlayer(target);
    }, container);
  });
}






const loadYoutubeApi = () => {
  return new Promise((resolve, reject) => {
    if (dom.body.classList.contains('youtube-is-loaded')) {
      resolve();
      return;
    }
    let script = dom.create('script', { src: YOUTUBE_API });
    dom.document.head.appendChild(script);
    dom.window.onYouTubeIframeAPIReady = () => {
      if (dom.body.classList.contains('youtube-is-loaded')) return;
      dom.addClass(dom.body, 'youtube-is-loaded');
      resolve();
    }
  });
}





const initPlayer = target => {
  if (target.classList.contains('loading')) return;

  let id = target.dataset.id;
  let playerId = target.dataset.playerId;
  if (!id || !playerId) return;

  dom.addClass(target, 'loading');

  let player = new YT.Player(playerId, {
    height: '390',
    width: '640',
    videoId: id,
    events: {
      onReady: () => {
        player.playVideo();
        dom.addClass(target, 'loaded');
      }
    }
  });
}




