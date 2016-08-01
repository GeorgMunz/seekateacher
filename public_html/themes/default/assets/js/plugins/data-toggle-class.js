$(function() {

  var $src = $('[data-toggle-class]');

  if ( ! $src.length) return;

  function init() {
    $src.each(function() {
      var $cur = $(this);
      var $tar = $($cur.data('target')),
          classes = $cur.data('toggle-class');


      $cur.on('click', function() {
        $tar.toggleClass(classes);
        console.log('called');
      });
    });
  }

  // Let's go
  init();
})

$(function() {

  var $src = $('[data-toggle-radio]');

  if ( ! $src.length) return;

  function init() {
    $src.each(function() {
      var $cur = $(this);
      var $tar = $($cur.data('target')),
          classes = $cur.data('toggle-radio');


      $cur.on('click', function() {
        $tar.toggleClass(classes);
        console.log('called');
      });
    });
  }

  // Let's go
  init();
})
