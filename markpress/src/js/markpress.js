var PageDown = require("pagedown");
var converter = new PageDown.Converter();

function MarkPress() {
    'use strict';
    this.editor = document.querySelector("#markpress-editor");
    this.preview = document.querySelector("#markpress-preview");

    this.bindKeydown();
    this.updatePreview();
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
};

MarkPress.prototype.updatePreview = function () {
    'use strict';
    this.preview.innerHTML = converter.makeHtml(this.editor.value);
};

var MP = new MarkPress();