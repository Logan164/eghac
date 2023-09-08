import $ from 'jquery';

const nav = () => {
  const toggle = $('.js-nav-toggle');
  if (toggle.length) {
    const $body = $('body');

    toggle.on('click', ev => {
      ev.preventDefault();
      $body.toggleClass('nav-open');
    });
  }

  const nolink = $('.nolink > a:nth-child(1)');
  if (nolink.length) {
    nolink.on('click', ev => {
      ev.preventDefault();
      return false;
    });
  }
};
export default nav;
