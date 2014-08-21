var marked = require('marked');
marked.setOptions({
    renderer: new marked.Renderer(),
    gfm: true,
    tables: true,
    breaks: true,
    pedantic: true,
    sanitize: true,
    smartLists: true,
    smartypants: true
});
var request = require('superagent');

function Note(data) {
    'use strict';
    this.id = data.id;
    this.title = data.title;
    this.tags = data.tags;
    this.content = data.content;
}

Note.prototype.setPostId = function (id) {
    'use strict';
    this.id = id;
};

Note.prototype.savePost = function (cb) {
    'use strict';

    request.post("/")
        .type('form')
        .send({
            'mp-note-id': this.id,
            'mp-note-title': this.title,
            'mp-note-tags': this.tags,
            'mp-note-content': this.content,
            'mp-note-submit': true
        })
        .set('Accept', 'application/json')
        .end(function(res){
            var resObj = JSON.parse(res.text);

            if (resObj.saved !== true) {
                window.alert("Something is broken, sorry!");
            }

            this.setPostId(resObj.post_id);

            cb();
        }.bind(this));
};

module.exports = Note;