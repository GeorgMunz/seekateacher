$(function(){
  var $select2 = $('.select2');

  if ( ! $select2.length) return;

  $('.select2-tag').select2({
    tags: true
  });


  $('.select2').select2();
});
