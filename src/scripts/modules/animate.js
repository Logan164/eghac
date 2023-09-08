import inView from 'in-view';

const animate = () => {
  inView.threshold(0.1);

  const init = () => {
    inView('.animate').on('enter', el => {
      el.classList.add('animate-in');
    });
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
export default animate;
