function assign_opacity(e, t) {
    $slider = jQuery("#" + e);
    $opacity_txtbox = $slider.prev().children(".opacity");
    $opacity_value = $slider.prev().children(".opacity-value");
    $opacity_txtbox.val(t);
    $opacity_value.val(t)
}

function hide_options(e) {
    $chkbox = jQuery("#" + e);
    var t = $chkbox.siblings(".basic-option");
    var n = $chkbox.siblings(".advance-option");
    var r = $chkbox.siblings(".field-id").val();
    var i = jQuery("#" + r + "bgpattern").val();
    if ($chkbox.is(":checked")) {
        t.hide();
        n.show();
    } else {
        n.hide();
        t.show();
        jQuery("#" + r + "bgoptions:hidden").fadeIn("slow")
    }
}

function assign_selectbox_value(e, t, n) {
    selectbox = jQuery("#" + e + "-" + n);
    selectbox.children("option:selected").removeAttr("selected");
    selectbox.children('option[value="' + t + '"]').attr("selected", "selected");
    selectbox.val(t)
}
jQuery(document).ready(function () {
    jQuery(".ie-pattern-show").on("click", function (e) {
        jQuery(this).next(".pattern-collections").css("display", "block");
        return false
    });
    jQuery(".popup-colorpicker").each(function () {
        var e = jQuery(this);
        var t = e.val();
        var n = {
            "background-color": "#000000",
            color: "#000"
        }
    });
    jQuery(".be-img-select").on("change", function () {
        var e = jQuery(this);
        var t = e.val();
        var n = e.attr("id");
        var r = e.val();
        var i = e.parent(".ddOutOfVision").parent(".basic-option").siblings(".field-id").val();
        var s = jQuery("#" + n + r).val();
        jQuery("#" + i + "background").attr("value", t);
        if (s != null) {
            var o = s.split("/");
            var u = o[0];
            var a = o[1];
            var f = o[2];
            var l = o[3];
            var c = o[4];
            var h = o[5];
            if (u.length != 0) {
                jQuery("#" + i).each(function () {
                    jQuery(this).attr("value", u).css("background-color", u)
                })
            }
            if (a.length != 0) assign_selectbox_value(i, a, "recur");
            if (f.length != 0) assign_selectbox_value(i, f, "attach");
            if (l.length != 0) assign_selectbox_value(i, l, "position");
            if (c.length != 0) {
                jQuery("#" + i + "slider").each(function () {
                    $slider = jQuery(this);
                    $slider.slider({
                        animate: true,
                        range: "max",
                        min: 1,
                        max: 100,
                        value: c
                    });
                    assign_opacity($id, c)
                })
            }
            if (h.length != 0) {
                $radio_buttonset = e.parent().parent().siblings(".buttonset").children(".ui-helper-hidden-accessible");
                $label_buttonset = e.parent().parent().siblings(".buttonset").children(".ui-button-text-only");
                $label_buttonset.each(function () {
                    $this = jQuery(this);
                    if ($this.hasClass("ui-state-active")) {
                        $this.removeClass("ui-state-active");
                        $this.prev("radio").removeAttr("checked")
                    }
                    if ($this.val() == h) {
                        $this.attr("checked", "checked");
                        $this.next(".ui-button-text-only").addClass("ui-state-active")
                    }
                })
            }
        }
    });
    jQuery(".bg-hide-below").each(function (e, t) {
        var n = jQuery(this).attr("id");
        hide_options(n)
    });
    jQuery(".bg-hide-below").on("click", function (e, t) {
        var n = e.target.id;
        hide_options(n)
    });
    jQuery(".slider").bind("slide", function (e, t) {
        $id = e.target.id;
        assign_opacity($id, t.value)
    });
    jQuery(".slider").bind("slidechange", function (e, t) {
        $id = e.target.id;
        assign_opacity($id, t.value)
    })
});