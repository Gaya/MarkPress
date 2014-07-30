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

function MarkPress() {
    'use strict';
    this.editor = document.querySelector("#markpress-editor");
    this.preview = document.querySelector("#markpress-preview");
    this.entriesButton = document.querySelector("#actions .entries");
    this.modeButton = document.querySelector("#actions .mode");
    this.saveButton = document.querySelector("#actions .save");

    this.bindKeydown();
    this.updatePreview();
    this.bindButtons();
}

MarkPress.prototype.bindKeydown = function () {
    'use strict';

    this.editor.addEventListener("keydown", function (e) {
        if (e.keyCode === 9) { // tab was pressed
            // get caret position/selection
            var val = this.value,
                start = this.selectionStart,
                end = this.selectionEnd;

            // set textarea value to: text before caret + tab + text after caret
            this.value = val.substring(0, start) + '\t' + val.substring(end);

            // put caret at right position again
            this.selectionStart = this.selectionEnd = start + 1;

            // prevent the focus lose
            return false;
        }
    }.bind(this.editor), false);

    this.editor.addEventListener("input", function (e) {
        this.updatePreview();
    }.bind(this), false);

    this.editor.addEventListener("focus", function (e) {
        document.body.classList.remove("menu-open");
    }, false);
};

MarkPress.prototype.updatePreview = function () {
    'use strict';
    this.preview.innerHTML = this.markDownToHTML(this.editor.value);
};

MarkPress.prototype.markDownToHTML = function (md) {
    'use strict';
    return marked(md);
};

MarkPress.prototype.bindButtons = function () {
    'use strict';
    this.entriesButton.addEventListener("click", function () {
        document.body.classList.toggle("menu-open");
    }, false);
};

var MP = new MarkPress();