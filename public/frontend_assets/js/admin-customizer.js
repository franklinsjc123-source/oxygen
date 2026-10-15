// RTL & LTR
// Note: Floating button code removed to show the button in the header instead.

(function () {
})();

// live customizer js
$(document).ready(function () {
  localStorage.removeItem('dark-mode');
  $('body').removeClass('dark');

  $('.btn-rtl').on('click', function () {
    $("html").attr("dir", "");
    $(this).toggleClass('rtl');
    if ($('.btn-rtl').hasClass('rtl')) {
      $('.btn-rtl').text('LTR');
      $('body').addClass('rtl');
      $("html").attr("dir", "rtl");
    } else {
      $('.btn-rtl').text('RTL');
      $('body').removeClass('rtl');
      $("html").attr("dir", "");
    }
  });
});
