class URI {
  // store the segments
  segments:any;

  constructor() {
    // build the segments
    var segments = location.pathname.split('/');
    segments.shift(); // removing unwanted empty
    this.segments = segments;
  }

  assocToUri(assoc) {
    var arr = [];
    Object.keys(assoc).forEach(function(key){
      arr.push(key);
      arr.push(assoc[key]);
    });
    return arr.join('/');
  }
};

var uri = new URI();
export = uri;
