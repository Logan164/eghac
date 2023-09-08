import { ellipsis } from 'ellipsed';

const textTrim = () => {
  const el = document.querySelectorAll('.js-ellipsis');
  if (el.length) {
    ellipsis('.js-ellipsis', 3);
  }
  const el2 = document.querySelectorAll('.js-ellipsis-2');
  if (el2.length) {
    ellipsis('.js-ellipsis-2', 2);
  }
};
export default textTrim;
