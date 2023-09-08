import $ from 'jquery';

const video = () => {
  const play = $('.js-video-play');
  if (play.length) {
    play.on('click', ev => {
      ev.preventDefault();
      let $self = $(ev.target);
      if (!$self.hasClass('js-video-play')) {
        $self = $self.closest('.js-video-play');
      }
      const next = $self.next();
      if (next && !next.hasClass('c-embed--uploaded') && next.text()) {
        const html = $(next.text());
        next.empty();
        next.append(html);
      } else if (next.hasClass('c-embed--uploaded')) {
        next.find('video')[0].play();
      }
      $self.fadeOut();
    });
  }
};
export default video;
