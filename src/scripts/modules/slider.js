import $ from 'jquery';
import 'slick-carousel';

const slider = () => {
  const sliderOptions = {
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    prevArrow:
      '<button type="button" class="slick-prev"><span class="icon-arrow-left"><span class="path1"></span><span class="path2"></span></span></button>',
    nextArrow:
      '<button type="button" class="slick-next"><span class="icon-arrow-right"><span class="path1"></span><span class="path2"></span></span></button>',
    infinite: false,
    autoplay: false,
    pauseOnFocus: false,
    pauseOnHover: false,
    mobileFirst: true,
    responsive: [
      {
        breakpoint: 440,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 1024,
        settings: 'unslick',
      },
    ],
  };

  const $win = $(window);
  const checkSize = (sliderDesktop, unslicked) => {
    $win.on('resize', () => {
      if ($win.width() < 1024 && unslicked) {
        if (!sliderDesktop.hasClass('slick-initialized')) {
          sliderDesktop.slick(sliderOptions);
        }
      }
    });
  };

  const init = () => {
    const sliderWrapper = $('.js-slider-wrapper-mobile');
    if (sliderWrapper.length) {
      sliderWrapper.each((i, el) => {
        const singleWrapper = $(el);
        if (singleWrapper.length) {
          sliderOptions.appendArrows = singleWrapper.next();
          singleWrapper.on('unslick', () => {
            checkSize(singleWrapper, 1);
          });
          singleWrapper.slick(sliderOptions);
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
export default slider;
