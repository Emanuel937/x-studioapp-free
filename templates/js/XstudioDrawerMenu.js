(function ($, elementor) {
  "use strict";

  var XStudioApp = {
    init: function () {
      var widgets = {
        'xstudioapp_drawer_menu.default': XStudioApp.widgetDrawerMenu,
      };
      $.each(widgets, function (widget, callback) {
        elementorFrontend.hooks.addAction('frontend/element_ready/' + widget, callback);
      });
    },
    editorCheck: function () {
      return elementorFrontend.isEditMode();
    },
    debounce: function (func, wait) {
      let timeout;
      return function (...args) {
        const context = this;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), wait);
      };
    },
    widgetDrawerMenu: function ($scope) {
      var selectors = {
        button: '.x-studioapp-open-canvas-menu i[data-canvas-trigger]',
        overlay: '.x-studioapp-drawer-overlay',
      };

      function initDrawer() {
        // Unbind previous events to prevent duplicates
        $(document).off('click.xstudioDrawer', selectors.button);

        // Bind click event for drawer toggle
        $(document).on('click.xstudioDrawer', selectors.button, function (e) {
          e.preventDefault();
          e.stopPropagation();
          if (XStudioApp.editorCheck()) {
            console.log('[XStudioApp] Editor: Button clicked, toggling overlay');
          }
          $scope.find(selectors.overlay).toggleClass('x-studioapp-drawer-overlay-open');
        });

        // Close drawer when clicking outside (similar to WprElements)
        $(document).on('click.xstudioDrawerOutside', function (e) {
          if (
            !$(e.target).closest(selectors.overlay).length &&
            !$(e.target).closest(selectors.button).length &&
            $scope.find(selectors.overlay).hasClass('x-studioapp-drawer-overlay-open')
          ) {
            $scope.find(selectors.overlay).removeClass('x-studioapp-drawer-overlay-open');
          }
        });

        // Ensure overlay is initialized correctly in editor
        if (XStudioApp.editorCheck()) {
          $scope.find(selectors.overlay).css('display', ''); // Reset display to avoid editor glitches
        }
      }

      // Initial call
      initDrawer();

      // Use MutationObserver to rebind events on DOM changes (like WprElements)
      var mutationObserver = new MutationObserver(function (mutations) {
        initDrawer(); // Rebind events when DOM changes
      });

      mutationObserver.observe($scope[0], {
        childList: true,
        subtree: true,
      });

      // Re-initialize on Elementor preview refresh
      if (XStudioApp.editorCheck()) {
        elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($newScope) {
          if ($newScope.data('widget_type') === 'xstudioapp_drawer_menu.default') {
            initDrawer(); // Rebind for newly added widgets
          }
        });
      }
    },
  };

  $(window).on('elementor/frontend/init', function () {
    XStudioApp.init();
  });
})(jQuery, window.elementorFrontend);