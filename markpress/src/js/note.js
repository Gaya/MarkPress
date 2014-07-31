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

function Note() {
    'use strict';
    this.id = null;
    this.title = null;
    this.tags = null;
    this.content = null;
    this.editing = false;
    this.saving = false;
    this.interval = null;

    this.idElement = document.querySelector(".markpress-editor__content input[name=wp-note-id]");
    this.titleElement = document.querySelector(".markpress-editor__content__title input");
    this.tagsElement = document.querySelector(".markpress-editor__content__tags input");
    this.contentElement = document.querySelector("#markpress-editor");
    this.previewElement = document.querySelector("#markpress-preview");

    this.newButton = document.querySelector("#actions .new");
    this.saveButton = document.querySelector("#actions .save");

    this.init();
}

Note.prototype.init = function () {
    'use strict';
    this.setValues();
    this.bindEvents();
    this.startAutoSave();
    this.updatePreview();
};

Note.prototype.updatePreview = function () {
    'use strict';
    this.previewElement.innerHTML = this.markDownToHTML(this.contentElement.value);
};

Note.prototype.markDownToHTML = function (md) {
    'use strict';
    return marked(md);
};

Note.prototype.bindEvents = function () {
    'use strict';
    this.titleElement.addEventListener("input", this.setEditing.bind(this), true);
    this.tagsElement.addEventListener("input", this.setEditing.bind(this), true);
    this.contentElement.addEventListener("input", function (e) {
        this.setEditing();
        this.updatePreview();
    }.bind(this), false);

    this.newButton.addEventListener("click", this.newPost.bind(this));
    this.saveButton.addEventListener("click", this.savePost.bind(this));
};

Note.prototype.setEditing = function () {
    'use strict';
    if (this.editing === false) {
        this.editing = true;
    }
};

Note.prototype.setPostId = function (id) {
    'use strict';
    this.id = id;
    this.idElement.value = id;
};

Note.prototype.setValues = function () {
    'use strict';
    if (this.titleElement.value.length === 0) {
        this.titleElement.value = this.getDateTitle();
    }

    this.id = this.idElement.value;
    this.title = this.titleElement.value;
    this.tags = this.tagsElement.value;
    this.content = this.contentElement.value;
};

Note.prototype.startAutoSave = function () {
    'use strict';
    this.interval = setInterval(function () {
        if (this.editing === true && this.saving === false) {
            this.savePost();
        }
    }.bind(this), 10000);
};

Note.prototype.savePost = function () {
    'use strict';
    this.setValues();

    this.saveButton.innerHTML = "saving...";

    request.post("/")
        .type('form')
        .send({
            'wp-note-id': this.id,
            'wp-note-title': this.title,
            'wp-note-tags': this.tags,
            'wp-note-content': this.content,
            'wp-note-submit': true
        })
        .set('Accept', 'application/json')
        .end(function(res){
            var resObj = JSON.parse(res.text);

            if (resObj.saved !== true) {
                alert("Something is broken, sorry!");
            }

            this.setPostId(resObj.post_id);
            this.editing = false;
            this.saving = false;

            this.saveButton.innerHTML = "save";
        }.bind(this));
};

Note.prototype.newPost = function () {
    'use strict';
    this.idElement.value = null;
    this.titleElement.value = this.getDateTitle();
    this.tagsElement.value = "";
    this.contentElement.value = "";
    this.setValues();
    this.updatePreview();
};

Note.prototype.getDateTitle = function () {
    'use strict';
    var currentDate = new Date();
    var day = currentDate.getDate();
    var month = currentDate.getMonth() + 1;
    var year = currentDate.getFullYear();

    return day + " / " + month + " / " + year;
};

module.exports = Note;