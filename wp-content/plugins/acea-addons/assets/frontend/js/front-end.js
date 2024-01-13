! function ($) {
    "use strict";
    xdLocalStorage.init({
        iframeUrl: "https://leap13.github.io/pa-cdcp/",
        initCallback: function () { }
    });
    var acea_cp_settings = jQuery('.elementor-section');
        acea_cp_settings.each(function (index) {
            var acea_cp_setting = $(this).data("settings"),
                acea_cp_section = $(this);
            if('yes' == acea_cp_setting.acea_copy_paste_enable ){
                acea_cp_section.append("<button class='acea-copy-data'> Live Copy </button>"),
                $(this).find(".acea-copy-data").click(function (e) {
                    e.preventDefault()
                    var acea_jeson_data = acea_cp_setting.acea_copy_json_data
                    xdLocalStorage.setItem("acea-c-p-element", acea_jeson_data)
                    $(this).text('Copied Done');
                    var copy_text = $(this)
                    setTimeout(function() {
                        copy_text.text('Live Copy');
                    }, 5000);
                })
            }
        })
}(jQuery);
