xl.format_amount = function(amount) {
	amount = parseFloat(amount);
	return amount.toFixed(2);
}

xl.round_amount = function(amount) {
	return xc.format_amount( Math.round( parseFloat(amount) ) );
}
;
// TODO string to
xl.to_bytes = function(str) {

	var explode = str.split(' ');

	var value = explode[0];

	var unit = explode[1];

	var multiplier = {
		'MB': 1000000,
		'KB': 1000
	};

	return value * multiplier[unit];
}
;/*\
|*|
|*|  :: cookies.js ::
|*|
|*|  A complete cookies reader/writer framework with full unicode support.
|*|
|*|  Revision #1 - September 4, 2014
|*|
|*|  https://developer.mozilla.org/en-US/docs/Web/API/document.cookie
|*|  https://developer.mozilla.org/User:fusionchess
|*|
|*|  This framework is released under the GNU Public License, version 3 or later.
|*|  http://www.gnu.org/licenses/gpl-3.0-standalone.html
|*|
|*|  Syntaxes:
|*|
|*|  * docCookies.setItem(name, value[, end[, path[, domain[, secure]]]])
|*|  * docCookies.getItem(name)
|*|  * docCookies.removeItem(name[, path[, domain]])
|*|  * docCookies.hasItem(name)
|*|  * docCookies.keys()
|*|
\*/

xl.docCookies = {
  getItem: function (sKey) {
    if (!sKey) { return null; }
    return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
  },
  setItem: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
    if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) { return false; }
    var sExpires = "";
    if (vEnd) {
      switch (vEnd.constructor) {
        case Number:
          sExpires = vEnd === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + vEnd;
          break;
        case String:
          sExpires = "; expires=" + vEnd;
          break;
        case Date:
          sExpires = "; expires=" + vEnd.toUTCString();
          break;
      }
    }
    document.cookie = encodeURIComponent(sKey) + "=" + encodeURIComponent(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
    return true;
  },
  removeItem: function (sKey, sPath, sDomain) {
    if (!this.hasItem(sKey)) { return false; }
    document.cookie = encodeURIComponent(sKey) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "");
    return true;
  },
  hasItem: function (sKey) {
    if (!sKey) { return false; }
    return (new RegExp("(?:^|;\\s*)" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
  },
  keys: function () {
    var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
    for (var nLen = aKeys.length, nIdx = 0; nIdx < nLen; nIdx++) { aKeys[nIdx] = decodeURIComponent(aKeys[nIdx]); }
    return aKeys;
  }
};;
xl.file_ext = function(filename) {
	return filename.substr(filename.lastIndexOf('.') + 1);
};

// Read as Data URL
xl.read_data_url = function(file, callback) {
	var reader = new FileReader();
    reader.onload = function (event) {
    	callback(event.target.result);
    }
    reader.readAsDataURL(file);
};

// Check the File Type
xl.file_type = function(file, callback) {
	xl.read_data_url(file, function(data_url) {
		var file_type = data_url.split(",")[0].split(":")[1].split(";")[0];
		callback(file_type);
	});
};;
xl.file_upload_xhr = function($el) {
	var myXhr = $.ajaxSettings.xhr();
	if(myXhr.upload) { // Check if upload property exists
		myXhr.upload.addEventListener('progress', function(event) {
			if(event.lengthComputable) {
				var per = Math.round(( event.loaded / event.total ) * 100) + '%';
				$el.css('width', per);
				$el.html(per);
			}
		}, false); // For handling the progress of the upload
	}
	return myXhr;
}
;/* --------------------------------------------------------------
 * IMAGE VALIDATIONS
 * ------------------------------------------------------------ */

// verify file type is jpg or not
xl.is_jpg_fr = function(file, callback) {

	// Check file type
	xl.file_type(file, function(mime_type) {
		var valid = false;

		if ( mime_type == 'image/jpg' || mime_type == 'image/jpeg' ) {
			valid = true;
		}

		// calling the callback
		callback(valid);
	});

};


xl.is_jpg = function(file) {
	var valid = false,
		mime_type = file.type;

	if ( mime_type == 'image/jpg' || mime_type == 'image/jpeg' ) {
		valid = true;
	}

	return valid;
};

xl.image_from_file = function(file, callback) {
	var url = URL.createObjectURL(file);
	var img = new Image;

	img.onload = function() {
	    callback(img);
	};

	img.src = url;
};
;

xl.reload = function() {
	xl.redirect(window.location.href);
}

xl.redirect = function(url) {
	window.location.replace(url);
}
;/* --------------------------------------------------------------
 * IMAGE PREVIEW
 * ------------------------------------------------------------ */

/**
 * image preview
 */
/*
<div class="img-preview" data-img-preview="#upload_1">
	<span class="glyphicon glyphicon-plus"></span>
</div>
<input type="file" id="upload_1" class="hide" name="upload_1">
 */
$(function() {

	function init() {
		$('[data-img-preview]').each(function() {
			var $preview = $(this),
				$input = $( $preview.data('img-preview') ),
				allowed_types = $preview.data('img-allowed'),
				allowed_size = $preview.data('img-size'),
				allowed_width = $preview.data('img-width'),
				allowed_height = $preview.data('img-height');

			// Attaching on change
			$input.on('change', function() {
				var file = this.files[0];

				if ( ! file) return false;

				// check file size
				if (file.size > xl.to_bytes(allowed_size)) {
					bootbox.alert('Only less than 1MB');
					return false;
				}

				// only jpg
				if ( ! xl.is_jpg(file)) {
	    			bootbox.alert('Only JPG are allowed');
					return false;
	    		}

	    		// check width and height
	    		xl.image_from_file(file, function(img) {

	    			if (img.width < allowed_width) {
	    				bootbox.alert('Min width should be ' + allowed_width + 'px');
	    				return false;
	    			}

	    			if (img.height < allowed_height) {
	    				bootbox.alert('Min height should be ' + allowed_height + 'px');
	    				return false;
	    			}

		    		// success then read
	    			$preview.css('background-image', 'url("'+img.src+'")' );
	    		});

			});
			// Attaching on click
			$preview.on('click', function(){
				$input.trigger('click');
			});
		});
	}

	// let's go
	init();

	xl.image_preview_init = init;
});
;
$(function(){

	$ss = $('[data-social-sharing]');

	if ( ! $ss) return;

	function init() {

		var url 	= window.location.href,
			domain  = document.domain,
			title 	= document.title,
			pic		= $ss.data('social-sharing-pic');

		var links	= {};
		links.fb 	= 'http://www.facebook.com/sharer/sharer.php?u='+url+'&title='+title;
		links.tw 	= 'http://twitter.com/intent/tweet?status='+title+'-'+url;
		links.gp 	= 'https://plus.google.com/share?url='+url;
		links.ln 	= 'http://www.linkedin.com/shareArticle?mini=true&url='+url+'&title='+title+'&source='+domain;
		links.pt 	= 'http://pinterest.com/pin/create/bookmarklet/?media='+pic+'&url='+url+'&is_video=false&description='+title;

		// Attaching event
		$ss.each(function(){

			var $cur = $(this);

			$cur.find('a').each(function() {
				// Get curr a
				var $a = $(this);

				// Get the url
				var url = links[ $a.attr('class') ];

				// Setting href
				$a.attr('href', url);
				
				$a.on('click', function(event) {
					// Stopping 
					event.preventDefault();

					// Popup
					popup(url);
				});
			});

		});

	}

	function popup(url) {
		var left  = ($(window).width()/2)-(900/2),
		    top   = ($(window).height()/2)-(600/2),
    		popup = window.open(url, "popup", "width=900, height=600, top="+top+", left="+left);
	}

	// Let's go
	init();

});;$(function() {

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
;$(function(){
  if (typeof $('.datetimepicker').datetimepicker == 'undefined') return;

  $('.datetimepicker').datetimepicker({
    'format': "YYYY-MM-DD HH:mm:ss"
  });

})
;$(function(){
  var $select2 = $('.select2');

  if ( ! $select2.length) return;

  $('.select2-tag').select2({
    tags: true
  });


  $('.select2').select2();
});
;$(function(){
  if (typeof tinymce == 'undefined') return;
  tinymce.init({
   selector: '.tinymce',
   menubar: false
  });
})
;$(function() {

if ( ! $('.typeahead').length) return;
var friends = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  // `states` is an array of state names defined in "The Basics"
  prefetch: '/api/friends'
});

$('.typeahead').typeahead(null, {
  name: 'friends',
  display: 'email',
  source: friends,
  template: {
    empty: [
      '<div class="empty-message">',
        'unable to find any Best Picture winners that match the current query',
      '</div>'
    ].join('\n'),
    suggestion: function(data) {
      console.log(data);

      return '<div class="media">\
                <div class="media-left">\
                  <img class="media-object" src="'+data.profile_pic+'">\
                </div>\
                <div class="media-body">\
                  <h4 class="media-heading">'+data.email+'</h4>\
                  <p>'+data.name+'</p>\
                </div>\
              </div>';
    }
  }
});

});
;if (typeof angular != 'undefined') {

  var profileControllers = angular.module('profileControllers', []);

  profileControllers.controller('PublicProfileCtrl', ['$scope', '$http',
    function($scope, $http) {
      $http.get('/api/public-profile').success(function(data){
        console.log(data);
        $scope.publicProfile = data;
      });

      this.save = function() {
        console.log($scope.publicProfile);
        $.post('/api/public-profile', $scope.publicProfile).success(function(data){
          console.log(data);
        });
      }
    }
  ]);
  
}
;if (typeof angular != 'undefined') {
  var profileApp = angular.module('profileApp', ['profileControllers', 'ngRoute']);

  // profileApp.config(['$routeProvider',
  //   function($routeProvider) {
  //     $routeProvider.
  //       when('/teacher/profile', {
  //         controller: 'PublicProfileCtrl'
  //       });
  //   }
  // ]);
}
;$(function(){
  $('[data-action="job-user"]').on('click', function() {
    var $btn = $(this);
    var url = $btn.data('url');
    
    $.get(url, function() {
      $btn.html($btn.data('after-text'));
    });
  });
});
;$(function() {
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
;
/* ========================================================================
* DOM-based Routing
* Based on http://goo.gl/EUTi53 by Paul Irish
*
* Only fires on body classes that match. If a body class contains a dash,
* replace the dash with an underscore when adding it to the object below.
*
* .noConflict()
* The routing is enclosed within an anonymous function so that you can
* always reference jQuery with $, even when in .noConflict() mode.
*
* Google CDN, Latest jQuery
* To use the default WordPress version of jQuery, go to lib/config.php and
* remove or comment out: add_theme_support('jquery-cdn');
* ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Roots = {
    // All pages
    common: {
      init: function() {
        // JavaScript to be fired on all pages
      }
    },
    // Home page
    home: {
      init: function() {
        // JavaScript to be fired on the home page
      }
    },
    // About us page, note the change from about-us to about_us.
    about_us: {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var namespace = Roots;
      funcname = (funcname === undefined) ? 'init' : funcname;
      if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      UTIL.fire('common');

      $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
        UTIL.fire(classnm);
      });
    }
  };

  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
