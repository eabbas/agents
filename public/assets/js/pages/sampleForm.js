jQuery(document).ready(function(a) {
    animated_text_area();
    file_input_trigger()
});

function animated_text_area() {
    $(".animatedTextArea").autosize({
        append: "\n"
    })
}

function file_input_trigger() {
    $("#file-3").fileinput({
        showCaption: false,
        browseClass: "btn btn-ls",
        fileType: "any",
        showUpload: false
    });
    $("#file-4").fileinput({
        showCaption: false,
        browseClass: "btn btn-success btn",
        fileType: "any",
        showUpload: false
    })
};