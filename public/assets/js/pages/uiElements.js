jQuery(document).ready(function(a) {
    progress_bar_call();
    toolbar_call();
    rating_call();
    tooltip_pophover_call();
    easy_pie_chart_call();
    tabulous_trigger_call();
    qrcode_call();
    bootbox_trigger_call()
});

function progress_bar_call() {
    $(".progress-bar").progressbar({
        display_text: "fill"
    })
}

function toolbar_call() {
    $("#button-right").toolbar({
        content: "#user-options",
        position: "right"
    });
    $("#normal-button").toolbar({
        content: "#user-options",
        position: "top"
    });
    $("#button-left").toolbar({
        content: "#user-options",
        position: "left"
    });
    $("#button-bottom").toolbar({
        content: "#user-options",
        position: "bottom"
    });
    $("#link-toolbar").toolbar({
        content: "#user-options-small",
        position: "top"
    })
}

function rating_call() {
    $("#ls-rating").on("change", function() {
        var a = $(this).val();
        if (a) {
            a = "Rating Changed: " + a
        } else {
            a = "Rating removed"
        }
        notificationCenter("glyphicon glyphicon-ok", "alert-success", a, "bottom right")
    })
}

function tooltip_pophover_call() {
    $(".tooltipLink").tooltip({
        animation: true
    });
    $(".popoverBox").popover({
        animation: true
    })
}

function easy_pie_chart_call() {
    $(".easyPieChart").easyPieChart({
        barColor: $redActive,
        scaleColor: $redActive,
        easing: "easeOutBounce",
        onStep: function(g, f, e) {
            $(this.el).find(".easyPiePercent").text(Math.round(e))
        }
    });
    var d = window.chart = $(".easyPieChart").data("easyPieChart");
    $(".js_update").on("click", function() {
        d.update(Math.random() * 200 - 100)
    });
    $(".easyPieChartBlue").easyPieChart({
        barColor: $lightBlueActive,
        scaleColor: $lightBlueActive,
        easing: "easeOutBounce",
        onStep: function(g, f, e) {
            $(this.el).find(".easyPiePercentBlue").text(Math.round(e))
        }
    });
    var c = window.chart = $(".easyPieChartBlue").data("easyPieChart");
    $(".js_update_blue").on("click", function() {
        c.update(Math.random() * 200 - 100)
    });
    $(".easyPieChartGreen").easyPieChart({
        barColor: $greenActive,
        scaleColor: $greenActive,
        easing: "easeOutBounce",
        onStep: function(g, f, e) {
            $(this.el).find(".easyPiePercentGreen").text(Math.round(e))
        }
    });
    var b = window.chart = $(".easyPieChartGreen").data("easyPieChart");
    $(".js_update_green").on("click", function() {
        b.update(Math.random() * 200 - 100)
    });
    $(".easyPieChartBrown").easyPieChart({
        barColor: $brownActive,
        scaleColor: $brownActive,
        easing: "easeOutBounce",
        onStep: function(g, f, e) {
            $(this.el).find(".easyPiePercentBrown").text(Math.round(e))
        }
    });
    var a = window.chart = $(".easyPieChartBrown").data("easyPieChart");
    $(".js_update_brown").on("click", function() {
        a.update(Math.random() * 200 - 100)
    })
}

function tabulous_trigger_call() {
    $("#tabs").tabulous({
        effect: "scale"
    });
    $("#tabs2").tabulous({
        effect: "slideLeft"
    });
    $("#tabs3").tabulous({
        effect: "scaleUp"
    })
}

function qrcode_call() {
    $("#qrcodeTable").qrcode({
        render: "table",
        text: "AimMate, email:aimmateteam@gmail.com"
    });
    $("#qrcodeCanvas").qrcode({
        text: "http://aimmate.com"
    })
}

function bootbox_trigger_call() {
    $("#alertBootBox").click(function() {
        bootbox.alert("Hello world!", function() {
            notificationCenter("glyphicon glyphicon-ok", "alert-success", "Hello world callback", "bottom right")
        })
    });
    $("#confirmBootBox").click(function() {
        bootbox.confirm("Are you sure?", function(a) {
            var b = "Confirm result: " + a;
            notificationCenter("glyphicon glyphicon-ok", "alert-success", b, "bottom right")
        })
    });
    $("#promptrmBootBox").click(function() {
        bootbox.prompt("What is your name?", function(a) {
            if (a === null) {
                notificationCenter("fa fa-power-off", "alert-danger", "Prompt dismissed", "bottom right")
            } else {
                var b = "Hi: " + a;
                notificationCenter("glyphicon glyphicon-user", "alert-success", b, "bottom right")
            }
        })
    });
    $("#customDialogBootBox").click(function() {
        bootbox.dialog({
            message: "I am a custom dialog",
            title: "Custom title",
            buttons: {
                success: {
                    label: "Success!",
                    className: "ls-light-green-btn btn-xs",
                    callback: function() {
                        notificationCenter("fa fa-check", "alert-success", "Great Success", "bottom right")
                    }
                },
                danger: {
                    label: "Danger!",
                    className: "ls-red-btn btn-xs",
                    callback: function() {
                        notificationCenter("fa fa-exclamation", "alert-danger", "Danger Here", "bottom right")
                    }
                },
                main: {
                    label: "Click ME!",
                    className: "btn-info btn-xs",
                    callback: function() {
                        notificationCenter("fa fa-info", "alert-info", "Info Button", "bottom right")
                    }
                }
            }
        })
    })
}

function notificationCenter(c, b, d, a) {
    $.notify.addStyle("custom", {
        html: "<div><div class='clearfix'><div class='customNotification alert " + b + "'><span class='" + c + "'></span>  " + d + "</div></div></div>"
    });
    $.notify("Message", {
        style: "custom",
        className: "superblue",
        autoHide: true,
        globalPosition: a
    })
};