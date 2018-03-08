/*global jQuery, document, wp, rcp_mailchimp_pro_vars*/
(function ($) {
    "use strict";

    var rcpListGroups = function () {
        var SELF = this;

        SELF.init = function () {
            SELF.$list = $(document.getElementById("rcp_mailchimp_pro_settings[saved_list]"));
            SELF.$group = $(document.getElementById("rcp_mailchimp_pro_settings[saved_group]"));
            SELF.$no_api_key = $(document.getElementById("rcp_mailchimp_pro_no_api_key_groups"));

            if (!SELF.$list.length || !SELF.$group.length) {
                SELF.$list = $(document.getElementById("rcp-mailchimp-pro-list"));
                SELF.$group = $(document.getElementById("rcp-mailchimp-pro-group"));
            }

            if (!SELF.$list.length || !SELF.$group.length) {
                return;
            }

            SELF.$list.on("change", SELF.getGroups);

            if (SELF.$no_api_key.length > 0) {
                SELF.$list.change();
            }
        };

        SELF.getGroups = function (e) {
            var $list = $(e.target);

            SELF.$no_api_key.remove();
            SELF.$group.after("<span class='loading'>&nbsp;Loading...</span>");
            SELF.$group.attr("disabled", "disabled");

            wp.ajax.send("rcpmp_get_groups", {
                success: SELF.updateGroups,
                error: SELF.handleError,
                data: {
                    list: $list.val(),
                    nonce: rcp_mailchimp_pro_vars.nonce
                }
            });
        };

        SELF.updateGroups = function (groups) {
            SELF.$group.parent().find(".loading").remove();
            SELF.$group.attr("disabled", false);
            SELF.$group.html(groups);
            SELF.$group.show();
        };

        SELF.handleError = function () {
            SELF.$group.parent().find(".loading").remove();
            SELF.$group.after("<span class='loading'>&nbsp;Something went wrong, please reload the page and try again.</span>");
        };

        SELF.init();
    };

    $(document).ready(function () {
        new rcpListGroups();
    });
})(jQuery);