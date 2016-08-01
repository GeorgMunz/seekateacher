$(function(){
  $('[data-action="job-user"]').on('click', function() {
    var $btn = $(this);
    var url = $btn.data('url');
    
    $.get(url, function() {
      $btn.html($btn.data('after-text'));
    });
  });
});
