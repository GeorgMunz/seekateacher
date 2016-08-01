declare var $;

class ImgPreview {

  static $mod = null;

  static init() {
    ImgPreview.$mod = $('[data-module="ImgPreview"]');
    if ( ! ImgPreview.$mod.length) return;
    ImgPreview.checkMaxFiles();
    ImgPreview.$mod.on('click', '[data-ImgPreview-remove]', ImgPreview.remove);
    ImgPreview.$mod.find('[data-ImgPreview-add]').on('click', ImgPreview.add);
  }

  static remove(event) {
    $(event.target).parents('[data-ImgPreview-thumb]').remove();
    ImgPreview.checkMaxFiles();
  }

  static add() {
    var $el = $($('#ImgPreviewTemplate').html());
    $el.find('input').click();
    $el.find('input').on('change', function() {
      var file = this.files[0];
      ImgPreview.createImgFromFile(file, function(img) {
        $el.find('.thumb').css('background-image', 'url('+img.src+')');
        $el.find('input').attr('name', 'pic-'+Math.random())

        // Attaching
        ImgPreview.$mod.find('[data-ImgPreview-add]').before($el);
        // check max
        ImgPreview.checkMaxFiles();
      });
    });
  }

  static createImgFromFile = function(file, callback) {
  	var url = URL.createObjectURL(file);
  	var img = new Image;
  	img.onload = function() {
  	    callback(img);
  	};
  	img.src = url;
  };

  static checkMaxFiles() {
    var count = ImgPreview.$mod.find('[data-ImgPreview-thumb]').length;
    if (count >= 3) {
      ImgPreview.$mod.find('[data-ImgPreview-add]').addClass('hide');
    }
    else {
      ImgPreview.$mod.find('[data-ImgPreview-add]').removeClass('hide');
    }
  }

}

export = ImgPreview;
