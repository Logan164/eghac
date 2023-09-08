import $ from 'jquery';

const slideToggle = () => {
  const toggle = $('.js-slide-toggle');
  if (toggle.length) {
    toggle.on('click', ev => {
      ev.preventDefault();
      let self = $(ev.target);
      if (!self.hasClass('js-slide-toggle')) {
        self = self.closest('.js-slide-toggle');
      }
      self.next().slideToggle();
    });
  }
};
export default slideToggle;
