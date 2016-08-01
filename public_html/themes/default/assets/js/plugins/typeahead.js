$(function() {

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
