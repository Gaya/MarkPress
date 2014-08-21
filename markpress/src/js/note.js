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
    this.editing = false;
    this.saving = false;
    this.interval = null;

    this.idElement = document.querySelector("#mp-note-id");
    this.titleElement = document.querySelector("#mp-title");
    this.tagsElement = document.querySelector("#mp-note-tags");
    this.contentElement = document.querySelector(".markpress-editor__content__editor");
    this.previewElement = document.querySelector(".markpress-editor__preview__container");

    this.newButton = document.querySelector(".markpress-actions__button--new");
    this.saveButton = document.querySelector(".markpress-actions__button--save");

    this.init();
}

Note.prototype.init = function () {
    'use strict';
    this.setInput();
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

Note.prototype.setInput = function () {
    "use strict";
    this.idElement.value = this.id;
    this.titleElement.value = this.title;
    this.tagsElement.value = this.tags;
    this.contentElement.value = this.content;
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