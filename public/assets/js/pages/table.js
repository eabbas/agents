jQuery(document).ready(function(a) {
    progressBar();
    table_DnD();
    table_Drag();
    table_Sort();
    data_editable_table();
    table_row_column_color()
});

function progressBar() {
    $(".progress-bar").progressbar();
    var a = $(".progress-bar");
    $("#m-multi-trigger").click(function() {
        $(".progress-bar").progressbar()
    })
}

function table_DnD() {
    $("#ls-row").tableDnD()
}

function table_Drag() {
    $("#ls-column").dragtable()
}

function table_Sort() {
    $(".ls-animated-table").tableSort({
        animation: "slide",
        speed: 500
    })
}

function data_editable_table() {
    $("#ls-editable-table").dataTable({
        sPaginationType: "full_numbers"
    }).makeEditable({
        sUpdateURL: function(b, a) {
            return (b)
        }
    })
}

function table_row_column_color() {
    $("#ls-row tr td:nth-of-type(odd)").css("background-color", "#EFF1F1");
    $("#ls-column tr td:nth-of-type(even)").css("background-color", "#EFF1F1")
};