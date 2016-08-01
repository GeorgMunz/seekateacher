
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

});