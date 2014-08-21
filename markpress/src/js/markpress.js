var request = require('superagent');
var Note = require('./Note.js');

function MarkPress() {
    'use strict';
    this.editor = document.querySelector(".markpress-editor__content__editor");
    this.entriesButton = document.querySelector(".markpress-actions__button--entries");
    this.modeButton = document.querySelector(".markpress-actions__button--mode");
    this.note = null;
    this.notes = [];

    this.init();
}

MarkPress.prototype.init = function () {
    'use strict';
    this.notes = this.getNotes();
    this.note = new Note();

    this.bindKeydown();
    this.bindButtons();
};

MarkPress.prototype.bindKeydown = function () {
    'use strict';

    this.editor.addEventListener("keydown", function (e) {
        if (e.keyCode === 9) { // tab was pressed
            // get caret position/selection
            var val = this.editor.value,
                start = this.editor.selectionStart,
                end = this.editor.selectionEnd;

            // set textarea value to: text before caret + tab + text after caret
            this.editor.value = val.substring(0, start) + '\t' + val.substring(end);

            // put caret at right position again
            this.editor.selectionStart = this.editor.selectionEnd = start + 1;

            // prevent the focus lose
            return false;
        }

        if (e.metaKey && e.keyCode === 83) {
            e.preventDefault();
            this.note.savePost();
            return false;
        }
    }.bind(this), false);

    this.editor.addEventListener("focus", function (e) {
        document.body.classList.remove("menu-open");
    }, false);
};

MarkPress.prototype.bindButtons = function () {
    'use strict';
    this.entriesButton.addEventListener("click", function () {
        document.body.classList.toggle("menu-open");
    }, false);

    this.modeButton.addEventListener("click", function () {
        document.body.classList.toggle("preview-open");

        if (this.modeButton.innerHTML === this.modeButton.getAttribute("data-text-on")) {
            this.modeButton.innerHTML = this.modeButton.getAttribute("data-text-off");
        } else {
            this.modeButton.innerHTML = this.modeButton.getAttribute("data-text-on");
        }
    }.bind(this), false);
};

MarkPress.prototype.getNotes = function () {
    'use strict';
    request.post("/")
        .type('form')
        .send({
            'mp-action': "get_notes"
        })
        .set('Accept', 'application/json')
        .end(function(res){
            var resObj = JSON.parse(res.text);
            console.log(res);
        }.bind(this));
};

var MP = new MarkPress();