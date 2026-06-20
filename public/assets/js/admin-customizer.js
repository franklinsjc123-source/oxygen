// RTL & LTR
// Note: Floating button code removed to show the button in the header instead.

(function () {
})();

// live customizer js
$(document).ready(function () {
  // Check and apply stored dark mode setting on load
  if (localStorage.getItem('dark-mode') === 'true') {
    $('.btn-dark-setting').addClass('dark');
    if (!$('.btn-dark-setting').hasClass('btn-dark-setting-icon')) {
      $('.btn-dark-setting').text('Light');
    }
    $('body').addClass('dark');
  } else {
    $('.btn-dark-setting').removeClass('dark');
    if (!$('.btn-dark-setting').hasClass('btn-dark-setting-icon')) {
      $('.btn-dark-setting').text('Dark');
    }
    $('body').removeClass('dark');
  }

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

  var body_event = $("body");
  body_event.on("click", ".btn-dark-setting", function () {
    $(this).toggleClass('dark');
    if ($(this).hasClass('dark')) {
      $('.btn-dark-setting').addClass('dark');
      if (!$('.btn-dark-setting').hasClass('btn-dark-setting-icon')) {
        $('.btn-dark-setting').text('Light');
      }
      $('body').addClass('dark');
      localStorage.setItem('dark-mode', 'true');
    } else {
      $('#theme-dark').remove();
      $('.btn-dark-setting').removeClass('dark');
      if (!$('.btn-dark-setting').hasClass('btn-dark-setting-icon')) {
        $('.btn-dark-setting').text('Dark');
      }
      $('body').removeClass('dark');
      localStorage.setItem('dark-mode', 'false');
    }
    return false;
  });
});
