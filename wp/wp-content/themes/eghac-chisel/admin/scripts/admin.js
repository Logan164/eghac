/* eslint-disable */
(function($) {
  $(document).ready(function() {
    window.acf.addAction('render_block_preview', function() {
      const event = new Event('blockPreviewReady');
      document.dispatchEvent(event);
    });
  });
})(jQuery);
