import $ from 'jquery';

const header = () => {
  const headerEl = $('.c-header');
  if (headerEl.length) {
    const $win = $(window);
    $win.on('scroll', () => {
      if ($win.scrollTop() > 30) {
        headerEl.addClass('scrolled');
      } else {
        headerEl.removeClass('scrolled');
      }
    });
  }
};
export default header;
