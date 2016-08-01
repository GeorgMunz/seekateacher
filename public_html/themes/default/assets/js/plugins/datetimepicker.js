$(function(){
  if (typeof $('.datetimepicker').datetimepicker == 'undefined') return;

  $('.datetimepicker').datetimepicker({
    'format': "YYYY-MM-DD HH:mm:ss"
  });

})
