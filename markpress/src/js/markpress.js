(function ($) {
    var converter = new Markdown.Converter();

    $(document).ready(function () {
        $("#markpress-editor").on("input", function () {
            updatePreview();
        }).on("keydown", function (e) {
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
        });

        updatePreview();
    });

    function updatePreview() {
        var content = $("#markpress-editor").val();
        $("#markpress-preview").html(converter.makeHtml(content));
    }
})(jQuery);