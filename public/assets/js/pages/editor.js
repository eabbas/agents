jQuery(document).ready(function(a) {
    summer_note_call();
    summer_note_theme_call();
    summer_note_air_mode_call();
    summer_note_custom_tool_bar_call()
});
var edit = function() {
    $(".click2edit").summernote({
        focus: true
    })
};
var save = function() {
    var a = $(".click2edit").code();
    $(".click2edit").destroy()
};

function summer_note_call() {
    $(".summernote").summernote({
        height: 150,
        minHeight: null,
        maxHeight: null,
        focus: true,
        codemirror: {
            theme: "monokai"
        }
    })
}

function summer_note_theme_call() {
    $(".summernoteTheme").summernote({
        height: 300,
        minHeight: null,
        maxHeight: null,
        focus: true
    })
}

function summer_note_air_mode_call() {
    $(".summernoteAirMode").summernote({
        airMode: true
    })
}

function summer_note_custom_tool_bar_call() {
    $(".customToolBar").summernote({
        toolbar: [
            ["style", ["bold", "italic", "underline", "clear"]],
            ["font", ["strikethrough"]],
            ["fontsize", ["fontsize"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["height", ["height"]],
        ]
    })
};