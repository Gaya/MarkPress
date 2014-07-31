var Note = require('./Note.js');

function MarkPress() {
    'use strict';
    this.editor = document.querySelector("#markpress-editor");
    this.entriesButton = document.querySelector("#actions .entries");
    this.modeButton = document.querySelector("#actions .mode");
    this.note = new Note();

    this.bindKeydown();
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

    this.editor.addEventListener("focus", function (e) {
        document.body.classList.remove("menu-open");
    }, false);
};

MarkPress.prototype.bindButtons = function () {
    'use strict';
    this.entriesButton.addEventListener("click", function () {
        document.body.classList.toggle("menu-open");
    }, false);
};

var MP = new MarkPress();