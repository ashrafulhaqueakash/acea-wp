(function ($) {
    "use strict";
$(window).on("elementor/frontend/init", function () {
    var Unfold = elementorModules.frontend.handlers.Base.extend({
        onElementChange: function (e) {
            if (e == 'unfold_text' || e == 'unfold_icon' || e == 'fold_text' || e == 'fold_icon' || e == 'fold_height' || e == 'transition_duration' || e == 'trigger' ) {
                this.run();
                if(e == 'fold_height') {
                    this.$element.find(".acea-unfold-data").css('height', this.getCollapseHeight() + "px");
                }
            }
        },
        getReadySettings: function () {
            var settings = {
                collapse_height: this.getElementSettings('fold_height') || 50,
                collapse_height_tablet: this.getElementSettings('fold_height_tablet') || this.getElementSettings('fold_height') || 50,
                collapse_height_mobile: this.getElementSettings('fold_height_mobile') || this.getElementSettings('fold_height_tablet') || this.getElementSettings('fold_height') || 50,
                trigger: this.getElementSettings('trigger'),
                transition_duration: this.getElementSettings('transition_duration') || 500,
                collapse_text: this.getElementSettings('unfold_text'),
                collapse_icon: this.getElementSettings('unfold_icon'),
                expand_text: this.getElementSettings('fold_text'),
                expand_icon: this.getElementSettings('fold_icon'),
            };
            return $.extend({}, settings);
        },
        getCollapseHeight: function() {
            var body = this.$element.parents('body');
            var unfoldSettings = this.getReadySettings();
            var collapse_height = 50;
            if (body.attr('data-elementor-device-mode') == 'desktop') {
                collapse_height = unfoldSettings.collapse_height;
            }
            if (body.attr('data-elementor-device-mode') == 'tablet') {
                collapse_height = unfoldSettings.collapse_height_tablet;
            }
            if (body.attr('data-elementor-device-mode') == 'mobile') {
                collapse_height = unfoldSettings.collapse_height_mobile;
            }
            return collapse_height;
        },
        fold: function (unfoldData, button, collapse_height) {
            var unfoldSettings = this.getReadySettings();
            var html = (unfoldSettings.collapse_icon)? ((unfoldSettings.collapse_icon.value) ? '<i aria-hidden="true" class="' + unfoldSettings.collapse_icon.value + '"></i>' : ''): '';
            html += (unfoldSettings.collapse_text) ? '<span>' + unfoldSettings.collapse_text + '</span>' : '';
            unfoldData.css('transition-duration', unfoldSettings.transition_duration + 'ms');
            unfoldData.animate({
                height: collapse_height
            }, 0);
            var timeOut = setTimeout(function(){
                button.html(html);
                clearTimeout(timeOut)
            }, unfoldSettings.transition_duration);
            unfoldData.removeClass("folded");
        },
        unfold: function (unfoldData, unfoldRender, button) {
            var unfoldSettings = this.getReadySettings();
            var html = (unfoldSettings.expand_icon)? ((unfoldSettings.expand_icon.value) ? '<i aria-hidden="true" class="' + unfoldSettings.expand_icon.value + '"></i>' : ''): '';
            html += (unfoldSettings.expand_text) ? '<span>' + unfoldSettings.expand_text + '</span>' : '';
            unfoldData.css('transition-duration', unfoldSettings.transition_duration + 'ms');
            unfoldData.animate({
                height: unfoldRender.outerHeight()
            }, 0);
            var timeOut = setTimeout(function(){
                button.html(html);
                clearTimeout(timeOut)
            }, unfoldSettings.transition_duration);
            unfoldData.addClass("folded");
        },
        run: function () {
            var $this = this;
            var button = this.$element.find(".acea-unfold-btn"),
                unfoldData = this.$element.find(".acea-unfold-data"),
                unfoldRender = this.$element.find(".acea-unfold-data-render");
            var unfoldSettings = this.getReadySettings();
            var collapse_height = $this.getCollapseHeight();
            unfoldData.css('height', collapse_height+'px');
            if (collapse_height >= unfoldRender.outerHeight()) {
                button.hide();
                unfoldData.addClass("folded");
            }
            if (unfoldSettings.trigger == 'click') {
                button.on("click", function () {
                    collapse_height = $this.getCollapseHeight();
                    if (unfoldData.hasClass("folded")) {
                        $this.fold(unfoldData, button, collapse_height);
                    } else {
                        $this.unfold(unfoldData, unfoldRender, button);
                    }
                });
            } else if (unfoldSettings.trigger == 'hover') {
                unfoldData.on('mouseenter', function () {
                    $this.unfold(unfoldData, unfoldRender, button);
                });
                unfoldData.on('mouseleave', function () {
                    collapse_height = $this.getCollapseHeight();
                    $this.fold(unfoldData, button, collapse_height);
                });
            }
        }
    });
    elementorFrontend.hooks.addAction( 'frontend/element_ready/acea-unfold.default', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(Unfold, {
                $element: $scope,
            });
        }
    );
});
})(jQuery);