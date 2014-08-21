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

function Editor(parent) {
    "use strict";

    this.parent = parent;
    this.interval = null;

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

Editor.prototype.init = function () {
    'use strict';
    this.bindEvents();
    this.startAutoSave();
};

Editor.prototype.updatePreview = function () {
    'use strict';
    this.previewElement.innerHTML = this.markDownToHTML(this.contentElement.value);
};

Editor.prototype.markDownToHTML = function (md) {
    'use strict';
    return marked(md);
};

Editor.prototype.bindEvents = function () {
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

Editor.prototype.setEditing = function () {
    'use strict';
    if (this.editing === false) {
        this.editing = true;
    }
};

Editor.prototype.newPost = function () {
    "use strict";

};

Editor.prototype.savePost = function () {
    "use strict";
    this.setValues();
    this.saveButton.innerHTML = "saving...";
    this.parent.note.savePost(function () {
        this.editing = false;
        this.saving = false;

        this.saveButton.innerHTML = "save";
    }.bind(this));
};

Editor.prototype.setInput = function () {
    "use strict";
    this.idElement.value = this.parent.note.id;
    this.titleElement.value = this.parent.note.title;
    this.tagsElement.value = this.parent.note.tags;
    this.contentElement.value = this.parent.note.content;
};

Editor.prototype.setValues = function () {
    "use strict";
    this.parent.note.id = this.idElement.value;
    this.parent.note.title = this.titleElement.value;
    this.parent.note.tags = this.tagsElement.value;
    this.parent.note.content = this.contentElement.value;
};

Editor.prototype.startAutoSave = function () {
    'use strict';
    this.interval = setInterval(function () {
        if (this.editing === true && this.saving === false) {
            this.savePost();
        }
    }.bind(this), 10000);
};

Editor.prototype.newPost = function () {
    'use strict';
    this.idElement.value = null;
    this.titleElement.value = this.getDateTitle();
    this.tagsElement.value = "";
    this.contentElement.value = "";
    this.updatePreview();
};

Editor.prototype.getDateTitle = function () {
    'use strict';
    var currentDate = new Date();
    var day = currentDate.getDate();
    var month = currentDate.getMonth() + 1;
    var year = currentDate.getFullYear();

    return day + " / " + month + " / " + year;
};

module.exports = Editor;