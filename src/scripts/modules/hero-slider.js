import $ from 'jquery';
import 'slick-carousel';

const heroSlider = () => {
  const sliderOptions = {
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: true,
    prevArrow:
      '<button type="button" class="slick-prev"><span class="icon-arrow-left"><span class="path1"></span><span class="path2"></span></span></button>',
    nextArrow:
      '<button type="button" class="slick-next"><span class="icon-arrow-right"><span class="path1"></span><span class="path2"></span></span></button>',
    appendArrows: '.js-slider-arrows',
    infinite: true,
    autoplay: true,
    pauseOnFocus: false,
    pauseOnHover: false,
    autoplaySpeed: 4000,
  };

  const beforeChange = (nextSlide, nav) => {
    nav.removeClass('active');
    nav.find('.js-slider-timeout').removeAttr('style');
    const active = $(`.js-slider-wrapper [data-slide="${nextSlide}"]`);
    active
      .find('.js-slider-timeout')
      .css({ 'transition-duration': `${sliderOptions.autoplaySpeed}ms` });
    setTimeout(() => {
      active.addClass('active');
    });
  };

  const init = () => {
    const sliderWrapper = $('.js-slider-wrapper');
    const sliderNav = sliderWrapper.find('.js-slider-nav-item');
    if (sliderWrapper.length) {
      sliderWrapper.each((i, el) => {
        const singleWrapper = $(el);
        const singleSlider = singleWrapper.find('.js-slider');
        if (singleSlider.length) {
          const speed = singleWrapper.data('slider-speed');
          if (speed) {
            sliderOptions.autoplaySpeed = speed;
          }
          singleSlider.on(
            'beforeChange',
            (event, slick, currentSlide, nextSlide) => {
              beforeChange(nextSlide, sliderNav);
            },
          );
          singleSlider.on('init', () => {
            if (sliderNav.length) {
              const first = sliderNav.first();
              first.find('.js-slider-timeout').css({
                'transition-duration': `${sliderOptions.autoplaySpeed}ms`,
              });
              setTimeout(() => {
                first.addClass('active');
              });
            }
          });
          singleSlider.slick(sliderOptions);
        }
      });
    }

    if (sliderNav.length) {
      sliderNav.first().addClass('active');
      sliderNav.on('click', ev => {
        ev.preventDefault();
        let $self = $(ev.target);
        if (!$self.hasClass('c-hero__slide-nav-link')) {
          $self = $self.closest('.c-hero__slide-nav-link');
        }
        const sliderFor = $($self.attr('href'));
        if (sliderFor.length) {
          sliderFor.slick('slickGoTo', parseInt($self.data('slide'), 10));
        }
      });
    }
  };
  init();

  document.addEventListener(
    'blockPreviewReady',
    () => {
      init();
    },
    false,
  );
};
export default heroSlider;
