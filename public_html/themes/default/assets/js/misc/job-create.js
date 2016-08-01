$(function() {
  var $btn_add_pic = $('#btn-job-add-pic');
  var pic_id = 1;
  if ( ! $btn_add_pic.length) return;

  function init() {
    $btn_add_pic.click(create_input);
  }

  function create_input(event) {
    // prevent form from submitting
    event.preventDefault();
    var $input = $('<div class="img-preview" data-img-preview="#upload_'+pic_id+'" data-img-allowed="jpg,jpeg" data-img-size="5 MB" data-img-width="600" data-img-height="600" > \
    	                <span class="glyphicon glyphicon-plus image-size"></span> \
                    </div> \
                    <input type="file" id="upload_'+pic_id+'" class="hide" name="upload_'+pic_id+'">');

    $btn_add_pic.parent().prepend($input);
    xl.image_preview_init();
    pic_id++;
  }

  // Let's go
  init();
});
