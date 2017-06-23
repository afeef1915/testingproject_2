var ThemerProvider = null;

var app_styles = [
    {
        key: 'DEFAULT',
        label: ClientDefaultTheme,
        color1: app_theme_color_1,
        color2: app_theme_color_2,
        href: client_theme_folder + 'css/default.css',
        client_main_logo: client_theme_folder + 'images/logos/client_logo.png'
    }
];

var initial_mtl_project_title = app_pre_title;

(function ($, window, document, undefined) {

    var pluginName = "metisMenu",
            defaults = {
                toggle: true
            };

    function Plugin(element, options) {
        this.element = element;
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype = {
        init: function () {

            var $this = $(this.element),
                    $toggle = this.settings.toggle;

            $this.find('li.active').has('ul').children('ul').addClass('collapse in');
            $this.find('li').not('.active').has('ul').children('ul').addClass('collapse');

            $this.find('li').has('ul').children('a').on('click', function (e) {
                e.preventDefault();

                $(this).parent('li').toggleClass('active').children('ul').collapse('toggle');

                if ($toggle) {
                    $(this).parent('li').siblings().removeClass('active').children('ul.in').collapse('hide');
                }
            });
        }
    };

    $.fn[ pluginName ] = function (options) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Plugin(this, options));
            }
        });
    };

})(jQuery, window, document);

$(function () {
    $('.sidebar-nav').height(parseInt($(window).height() - 50));
});

function handleSettingsTogglers() {
    toggleScreenWidth($('#merlin_screen_width').val());
    $('.settings-toggler input[type="checkbox"].fullwidth_trigger').each(function () {
        $(this).change(function () {
            var toggler = $(this);
            if (toggler.is(':checked')) {
                toggleScreenWidth('wide');
            } else {
                toggleScreenWidth('normal');
            }
        });
    });

    toggleDeveloperHelp($('.settings-toggler input[type="checkbox"].use_dev_help_trigger'), ($('#merlin_developer_help').val() == 'show' ? true : false));
    $('.settings-toggler input[type="checkbox"].use_dev_help_trigger').change(function () {
        var toggler = $(this);
        if (toggler.is(':checked')) {
            toggleDeveloperHelp(toggler, true);
        } else {
            toggleDeveloperHelp(toggler, false);
        }
    });
}

$(document).ready(function () {

//    $('.nano').nanoScroller({
//        preventPageScrolling: true
//    });

    $('.fullwidth_trigger').click(function () {
        toggleScreenWidth();
    });

    handleSettingsTogglers();

    $('#main_menu_switch_view_btn').click(function () {
        $('body').toggleClass('mini-sidebar');

    });

    $('body').append('<button class="btn btn-primary back-to-top"><i class="fa fa-arrow-up"></i></button>');

    $(window).resize(function () {
        $('.sidebar-nav').height(parseInt($(window).height() - 50));
    });

    var offset = 220;
    var duration = 500;
    $(window).scroll(function () {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(duration);
        } else {
            $('.back-to-top').fadeOut(duration);
        }
    });

    $('.back-to-top').click(function (event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    });

    if (isAuthenticated) {

        $('.settings_expander_trigger').on('click', function (e) {
            e.preventDefault();
            $('body').toggleClass('settings_expanded');
        });
        $('#settings_close').on('click', function (e) {
            e.preventDefault();
            $('body').removeClass('settings_expanded');
        });

        $("#font_resize_slider").slider({
            range: "min",
            animate: true,
            min: smallestFontSize,
            max: largestFontSize,
            step: 10,
            create: function (event, ui) {
                resizeFont(CurrentFontSize);
                $(".ui-slider-handle").addClass('mtl_tooltip');
            },
            slide: function (event, ui) {
                resizeFont(ui.value);
                $(".ui-slider-handle").attr('title', ui.value + '%');
            }
        });
        $("#font_resize_slider").bind("slidecreate", function (event, ui) {
            alert(ui.value);
            $(".ui-slider-handle").attr('title', ui.value);
            $(".ui-slider-handle").addClass('mtl_tooltip');
        });
        $("#font_resize_slider").slider()
                .find(".ui-slider-handle")
                .attr("title", CurrentFontSize + '%')
                .addClass('mtl_tooltip');
        $("#font_resize_slider").slider("option", "value", CurrentFontSize);

        $(".reset_font_btn").on('click', function () {
            $(documentMainContainer)
                    .removeClass('font_size_' + $("#view_font_size").val())
                    .addClass('font_size_' + originalFontSize);
            $("#font_resize_slider").slider("option", "value", originalFontSize);
            $("#view_font_size").val(originalFontSize);
        });
        $("#font_resize_slider_container .smallest").on('click', function () {
            $(documentMainContainer)
                    .removeClass('font_size_' + $("#view_font_size").val())
                    .addClass('font_size_' + smallestFontSize);
            $("#font_resize_slider").slider("option", "value", smallestFontSize);
            $("#view_font_size").val(smallestFontSize);
        });
        $("#font_resize_slider_container .largest").on('click', function () {
            $(documentMainContainer)
                    .removeClass('font_size_' + $("#view_font_size").val())
                    .addClass('font_size_' + largestFontSize);
            $("#font_resize_slider").slider("option", "value", largestFontSize);
            $("#view_font_size").val(largestFontSize);
        });
    }

    PrepareTooltips();
});

function resizeFont(fontSize) {
    $(documentMainContainer)
            .removeClass('font_size_' + $("#view_font_size").val())
            .addClass('font_size_' + parseInt(fontSize));
    $("#view_font_size").val(parseInt(fontSize));
    $("#font_resize_slider").slider("option", "value", parseInt(fontSize));
    return false;
}

(function (window) {
    var createModule = function (angular) {
        var module = angular.module('FBAngular', []);

        module.factory('Fullscreen', ['$document', function ($document) {
                var document = $document[0];

                var serviceInstance = {
                    all: function () {
                        serviceInstance.enable(document.documentElement);
                    },
                    enable: function (element) {
                        if (element.requestFullScreen) {
                            element.requestFullScreen();
                        } else if (element.mozRequestFullScreen) {
                            element.mozRequestFullScreen();
                        } else if (element.webkitRequestFullScreen) {
                            element.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                        } else if (element.msRequestFullscreen) {
                            element.msRequestFullscreen();
                        }
                    },
                    cancel: function () {

                        if (document.cancelFullScreen) {
                            document.cancelFullScreen();
                        } else if (document.mozCancelFullScreen) {
                            document.mozCancelFullScreen();
                        } else if (document.webkitCancelFullScreen) {
                            document.webkitCancelFullScreen();
                        } else if (document.msExitFullscreen) {
                            document.msExitFullscreen();
                        }
                    },
                    isEnabled: function () {
                        var fullscreenElement = document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement || document.msFullscreenElement;
                        return fullscreenElement;
                    },
                    toggleAll: function () {
                        serviceInstance.isEnabled() ? serviceInstance.cancel() : serviceInstance.all();
                    },
                    isSupported: function () {
                        var docElm = document.documentElement;
                        return docElm.requestFullScreen || docElm.mozRequestFullScreen || docElm.webkitRequestFullScreen || docElm.msRequestFullscreen;
                    }
                };

                return serviceInstance;
            }]);

        module.directive('fullscreen', ['Fullscreen', function (Fullscreen) {
                return {
                    link: function ($scope, $element, $attrs) {
                        // Watch for changes on scope if model is provided
                        if ($attrs.fullscreen) {
                            $scope.$watch($attrs.fullscreen, function (value) {
                                var isEnabled = Fullscreen.isEnabled();
                                if (value && !isEnabled) {
                                    Fullscreen.enable($element[0]);
                                    $element.addClass('isInFullScreen');
                                } else if (!value && isEnabled) {
                                    Fullscreen.cancel();
                                    $element.removeClass('isInFullScreen');
                                }
                            });
                            $element.on('fullscreenchange webkitfullscreenchange mozfullscreenchange', function () {
                                if (!Fullscreen.isEnabled()) {
                                    $scope.$evalAsync(function () {
                                        $scope[$attrs.fullscreen] = false
                                        $element.removeClass('isInFullScreen');
                                    })
                                }
                            })
                        } else {
                            $element.on('click', function (ev) {
                                Fullscreen.enable($element[0]);
                            });

                            if ($attrs.onlyWatchedProperty !== undefined) {
                                return;
                            }
                        }
                    }
                };
            }]);
        return module;
    };

    if (typeof define === "function" && define.amd) {
        define("FBAngular", ['angular'], function (angular) {
            return createModule(angular);
        });
    } else {
        createModule(window.angular);
    }
})(window);

angular.module('angular-themer', [])
        .provider('themer', function () {
            "use strict";
            var _styles = [], _selected = {label: '', href: ''}, _watchers = [];
            this.setStyles = function (styles) {
                _styles = styles;
            };
            var addWatcher = function (watcher) {
                _watchers.push(watcher);
            };
            var getSelected = this.getSelected = function () {
                return angular.copy(_selected);
            };
            var setSelected = this.setSelected = function (key) {
                angular.forEach(_styles, function (style) {
                    if (style.key === key) {
                        _selected = style;
                        angular.forEach(_watchers, function (watcher) {
                            watcher(getSelected());
                        });
                    }
                });
            };
            this.$get = [function () {
                    return {
                        styles: _styles,
                        getSelected: getSelected,
                        setSelected: setSelected,
                        addWatcher: addWatcher
                    };
                }];

        })
        .directive('themerLink', function () {
            "use strict";
            return {
                restrict: 'A',
                template: '<link ng-if="selected.href != false" rel="stylesheet" ng-href="{{ selected.href }}" />',
                replace: true,
                controller: ['$scope', 'themer', function (scope, themer) {
                        scope.selected = themer.getSelected();
                        themer.addWatcher(function (style) {
                            scope.selected = style;
                        });
                    }]
            };
        })
        .directive('themerSwitcher', function () {
            "use strict";
            return {
                restrict: 'A',
                template: '<div class="eserv_color_picker">\n\
                            <button title="{{ style.label }}" type="button" ng-repeat="style in theme.styles" class="mtl_tooltip" ng-class="{selected: (style.key===selected)}" ng-click="setTheme(style.key, style.client_main_logo)" ng-style="{ background: style.color1 }">\n\
                            <span ng-style="{ background: style.color2 }"></span>\n\
                            </button>\n\
                          </div>',
                scope: false,
                controller: ['$scope', '$rootScope', 'themer', function ($scope, $rootScope, themer) {

                        $scope.theme = {
                            styles: themer.styles,
                            selected: themer.getSelected().key
                        };

                        $scope.setTheme = function (themeKey, clientMainLogo) {
                            $rootScope.client_main_logo = clientMainLogo;
                            $scope.selected = themeKey;
                            $scope.theme = {
                                styles: themer.styles,
                                selected: themeKey
                            };
                        };

                        $scope.$watch('theme.selected', function () {
                            themer.setSelected($scope.theme.selected);
                        });
                    }]
            };
        });

angular
        .module('eserv.http_authentication', [])
        .config(function ($httpProvider, $provide) {
            $provide.factory('eservHttpAuthenticationInterceptor', function ($q, $rootScope) {
                var requests = 0;

                function show() {
                    if (!requests) {
                        $rootScope.$broadcast("ajax-start");
                    }
                    requests++;
                }

                function hide() {
                    requests--;
                    if (!requests) {
                        $rootScope.$broadcast("ajax-stop");
                    }
                }
                return {
                    'request': function (config) {
                        config.headers['X-Requested-With'] = "XMLHttpRequest";
                        if (typeof config.params != 'undefined') {
                            if (typeof config.params.ajax_main_loader == 'undefined' || config.params.ajax_main_loader !== false) {
                                show();
                            } else {
                                requests++;
                            }
                        } else {
                            show();
                        }
                        return $q.when(config);
                    },
                    'response': function (response) {
                        hide();
                        if ((typeof response.loggedIn != 'undefined' && !response.loggedIn) || 403 === response.status) {
                            HandleNotAuthenticated(false, false, notAuthenticatedCallback);
                        }
                        return $q.when(response);
                    },
                    'responseError': function (rejection) {
                        if ((typeof rejection.loggedIn != 'undefined' && !rejection.loggedIn) || 403 === rejection.status) {
                            HandleNotAuthenticated(false, false, notAuthenticatedCallback);
                        }
                        hide();
                        return $q.reject(rejection);
                    }
                };
            });

            $httpProvider.interceptors.push('eservHttpAuthenticationInterceptor');
        });

function notAuthenticatedCallback() {
    toggleMainLoader('Redirecting to login page...', true);
    return false;
}

angular
        .module('eserv.http_error_handling', [])
        .config(function ($httpProvider, $provide) {
            $provide.factory('eservHttpErrorHandlingInterceptor', function ($q, $rootScope) {
                return {
                    response: function (response) {
                        return response || $q.when(response);
                    },
                    responseError: function (rejection) {
                        if (rejection.status !== 0 && rejection.status !== -1) {
                            if (rejection.status != 403) {
                                DisplayAppAlert('danger', rejection.status + ' - ' + rejection.statusText + ' (Could not load page!)');
                            }
                        }
                        return $q.reject(rejection);
                    }
                };
            });

            $httpProvider.interceptors.push('eservHttpErrorHandlingInterceptor');
        });

var ESERV = angular
        .module('ESERV', [
            'ui.router',
            'ui.bootstrap',
            'angular-themer',
            'ngSanitize',
            'FBAngular',
            'ncy-angular-breadcrumb',
            'eserv.http_authentication',
            'eserv.http_error_handling',
            'dialogs.main'
        ])
        .run(
                ['$rootScope', '$state', '$stateParams', '$compile', '$breadcrumb', '$timeout', 'dialogs', 'preloader', 'themer', function ($rootScope, $state, $stateParams, $compile, $breadcrumb, $timeout, dialogs, preloader, themer) {

                        RootScope = $rootScope;
                        AJCompile = $compile;
                        TimeOut = $timeout;

                        EservDialogs = dialogs;
                        AJState = $state;


                        $rootScope.$state = $state;
                        $rootScope.$stateParams = $stateParams;

                        $rootScope.pageHeader = '';

                        $rootScope.appView = 'normal';
                        $rootScope.content_header_title = '';




                        $rootScope.isActive = function (stateName) {
                            return $state.includes(stateName);
                        };

                        $rootScope.getLastStepLabel = function () {
                            var states = $breadcrumb.getStatesChain();
                            return states[states.length - 1].ncyBreadcrumbLabel
                        };

                        $rootScope.refreshPage = function () {
                            $state.transitionTo($state.current, $stateParams, {
                                reload: true,
                                inherit: false,
                                notify: true
                            });
                        };

                        $rootScope.isLoading = true;
                        $rootScope.isSuccessful = false;
                        $rootScope.percentLoaded = 0 + '%';

                        var selected_theme_images_folder;

                        if (UserTheme == 'default') {
                            selected_theme_images_folder = client_theme_folder + 'images/';
                        } else {
                            selected_theme_images_folder = theme_folder + 'colors/images/' + UserTheme.toLowerCase() + '/';
                        }

                        $rootScope.imageLocations = [
                            (client_theme_folder + "images/logos/client_logo.png"),
                            (client_theme_folder + "images/main/processing_data.gif")
                        ];

                        preloader.preloadImages($rootScope.imageLocations).then(
                                function handleResolve(imageLocations) {
                                    $rootScope.isLoading = false;
                                    $rootScope.isSuccessful = true;
                                },
                                function handleReject(imageLocation) {
                                    $rootScope.isLoading = false;
                                    $rootScope.isSuccessful = false;
                                },
                                function handleNotify(event) {
                                    $rootScope.percentLoaded = event.percent + '%';
                                }
                        );

                        $rootScope.saveSettings = function () {
                            var SaveBtn = $('#eserv_user_save_settings');
                            var cookies = getMTLCookiesAsString();
                            SaveBtn.addClass('saving');
                            toggleMainLoader('Processing..', true);

                            $.ajax({
                                url: root_url + 'user/saveSettings',
                                type: 'POST',
                                data: {
                                    theme: UserTheme + '-' + themer.getSelected().key,
                                    theme_font_size: $('#view_font_size').val(),
                                    dashboard_portlets: $('#selected_dashboard_portlets').val(),
                                    layout: cookies,
                                    theme_width: $('#merlin_screen_width').val(),
                                    dev_help: $('#merlin_developer_help').val()
                                },
                                success: function (data) {
                                    toggleMainLoader('Processing..', false);
                                    DisplayAppAlert('success', data.msg);

                                },
                                error: function (err) {
                                    DisplayAppAlert('danger', err.statusText);
                                }
                                ,
                                statusCode: {
                                    500: function (error) {
                                        toggleMainLoader('Processing..', false);
                                        DisplayAppAlert('danger', 'An internal server error has occurred');
                                    }
                                }
                            });
                        };

                        $rootScope.$on('$stateChangeSuccess',
                                function (event, toState, toParams, fromState, fromParams) {
                                    $("#page-cover").css("opacity", 0.6).fadeOut(300);
                                    if (typeof toState.data != 'undefined') {
                                        $rootScope.mtl_project_title = (typeof toState.data.mtlProjectTitle != 'undefined') ? initial_mtl_project_title + toState.data.mtlProjectTitle : initial_mtl_project_title;
                                    } else {
                                        $rootScope.mtl_project_title = initial_mtl_project_title;
                                    }
                                    $("#eserv_main_loader").fadeOut(300, function () {
                                    });
                                });
                        $rootScope.$on('$stateChangeStart',
                                function (event, toState, toParams, fromState, fromParams) {
                                    toggleMainLoader('Loading..', true);
                                });
                        $rootScope.$on('$stateChangeError',
                                function (event, toState, toParams, fromState, fromParams, error) {
                                    $("#eserv_main_loader").fadeOut(300, function () {
                                        if (error.data.exception) {
                                            AJState.go(error.data.url.angular.url, {
                                                'param': error.data.url.angular.param_value
                                            });
                                            return false;
                                        }
                                        switch (error.data.status) {
                                            case 403:
                                                HandleNotAuthenticated(false, error.data.redirect_url);
                                                break;
                                            default:
                                                DisplayAppAlert('danger', error.status + ' - ' + error.statusText + ' (Could not load page!)');
                                                break;
                                        }
                                    });
                                });

                        $rootScope.Logout = function (size) {
                            var modalInstance = $modal.open({
                                templateUrl: 'logoutContent.html',
                                controller: LogoutCtrl,
                                size: size,
                                backdrop: 'static'
                            });
                            modalInstance.result.then(function () {

                            }, function () {
                                //$log.info('Modal dismissed at: ' + new Date());
                            });
                        };
                    }
                ])
        .filter('to_trusted', ['$sce', function ($sce) {
                return function (text) {
                    return $sce.trustAsHtml(text);
                };
            }])
        .config(['$httpProvider', '$urlRouterProvider', '$stateProvider', '$breadcrumbProvider', 'themerProvider', function ($httpProvider, $urlRouterProvider, $stateProvider, $breadcrumbProvider, themerProvider) {
                $breadcrumbProvider.setOptions({
                    prefixStateName: 'dashboard',
                    template: '<ol class="breadcrumb">\n\
                                <li ng-repeat="step in steps" ng-class="{active: $last}" ng-switch="$last || !!step.abstract">\n\
                                  <a title="{{ step.data.ncyBreadcrumbLabel }}" class="mtl_tooltip" data-tooltip-pos-at="bottom center" data-tooltip-pos-my="top center" ng-switch-when="false" href="#{{step.ncyBreadcrumbLink}}" ng-bind-html="step.ncyBreadcrumbLabel | to_trusted"></a>\n\
                                  <span ng-switch-when="true" ng-bind-html="step.ncyBreadcrumbLabel | to_trusted"></span>\n\
                                </li>\n\
                               </ol>'
                });
                $urlRouterProvider.otherwise('/dashboard/data'); //changed - to include the templateUrl specifically. 
                
              
               
                $stateProvider
                        .state('dashboard', {
                            url: '/dashboard/data',
                            templateUrl: root_url + 'dashboard/data',
                                                       
//                             resolve: {
//            auth: function ($q, authenticationSvc) {
//                var userInfo = authenticationSvc.getUserInfo()
//                alert(userInfo);
//            }},
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Dashboard'
                            }
                        })
//                           .state('total_logs', {
//                            url: '/total-logs/all/:id',
//                             templateUrl: root_url+ 'mylogs/list?p_customer_id=FBU',
//                            data:{
//                                
//                            },
////                            ncyBreadcrumb: {
////                                label: 'Dashboard'
////                            }
//                        })
                        .state('code', {
                            url: '/code',
                            abstract: true,
                            ncyBreadcrumb: {
                                label: 'Code'
                            },
                            data: {
                                ncyBreadcrumbLabel: 'Code',
                            }
                        })


                        .state('mylogs', {
                            url: '/mylogs',
                            abstract: true,
                            ncyBreadcrumb: {
                                label: 'My Logs'
                            },
                            data: {
                                ncyBreadcrumbLabel: 'My Logs',
                            }

                        })

                        .state('mylogs.render', {
                            url: '/render/:id',
                            data: {
                            },
//                            data: {
//                                ncyBreadcrumbLabel: 'Edit Mylogs',
//                                extraBtns: '<a ui-sref="organisation.school.school_add" class="btn btn-sm btn-success pull-right ng-scope" href="#/organisation/school/new"><i class="fa fa-plus-circle"></i> <span class="desktop_inline_text"> Add New School</span></a>',
//                                commsBtn: true,
//                                activitiesBtn: true
//                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        return root_url + 'mylogs/render/data/' + $node.id;
                                    }
                                }
                            }
                        })

                        .state('manageusers', {
                            url: '/manageusers',
                            abstract: true,
                            ncyBreadcrumb: {
                                label: 'Manage Users'
                            },
                            data: {
                                ncyBreadcrumbLabel: 'Show Users',
                            }
                        })

                        .state('manageusers.list', {
                            url: '/managelist',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Show Users'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        return root_url + 'users/manage-users?time=' + new Date().getTime();
                                    }
                                }
                            }
                        })

                        .state('showusers', {
                            url: '/showusers',
                            abstract: true,
                            ncyBreadcrumb: {
                                label: 'Show Users'
                            },
                            data: {
                                ncyBreadcrumbLabel: 'Show Users',
                            }
                        })


                        .state('showusers.form', {
                            url: '/person_form',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Person Form'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        return root_url + 'showusers/list?time=' + new Date().getTime();
                                    }
                                }
                            }
                        })
                        .state('showusers.list', {
                            url: '/list',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Show Users'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        return root_url + 'showusers/list?time=' + new Date().getTime();
                                    }
                                }
                            }
                        })
                        .state('mylogsassign', {
                            url: '/mylogsassign',
                            abstract: true,
                            ncyBreadcrumb: {
                                label: 'Mylogs'
                            },
                            data: {
                                ncyBreadcrumbLabel: 'mylogsassign',
                            }
                        })
                        .state('mylogsassign.list', {
                            url: '/list',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Logs Assigned'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        return root_url + 'mylogsassign/list?cc=' + customerCode + '&time=' + new Date().getTime();
                                    }
                                }
                            }
                        })

                        .state('mylogsassign.mymail', {
                            url: '/mymail/:id',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Send Mail'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {

                                        return root_url + 'mylogsassign/mymail/' + $node.id + '?time=' + new Date().getTime();

                                    }
                                }
                            }
                        })
                        .state('mylogs.list', {
                            url: '/list',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'My Logs'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        sessionStorage.setItem("page_url", "mylogs-list");
                                        return root_url + 'mylogs/list?time=' + new Date().getTime();
                                    }
                                }
                            }
                        })
//                         .state('mylogs.editlist', {
//                            url: '/edit-list',
//                            data: {
//                            },
//                            ncyBreadcrumb: {
//                                label: 'My Logs'
//                            },
//                            views: {
//                                "@": {
//                                    templateUrl: function ($node) {
//                                        return root_url + 'mylogs/edit?time=' + new Date().getTime();
//                                    }
//                                }
//                            }
//                        })
//                          .state('mylogs.form', {
//                            url: '/form',
//                            data: {
//                            },
//                            ncyBreadcrumb: {
//                                label: 'My Logs Portlets'
//                            },
//                            views: {
//                                "@": {
//                                    templateUrl: function ($node) {
//                                        return root_url + 'mylogs/portlets?time=' + new Date().getTime();
//                                    }
//                                }
//                            }
//                        })

                        .state('mylogs.form', {
                            url: '/list/:id/customer/:customer',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Edit Code'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {

                                        return root_url + 'mylogs/list/' + $node.id + '/customer/' + $node.customer + '?time=' + new Date().getTime();

                                    }
                                }
                            }
                        })

                        .state('mylogs.open_logs', {
                            url: '/open-logs',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'My Logs'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        sessionStorage.setItem("page_url", "open-logs");
                                        //sessionStorage.getItem("customers");
                                        return root_url + 'mylogs/view/' + sessionStorage.getItem("customer_new") + '?time=' + new Date().getTime();

                                    }
                                }
                            }
                        })

                        .state('mylogs.assigned_mtl', {
                            url: '/assigned-mtl',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'My Logs'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        sessionStorage.setItem("page_url", "assigned-mtl");
                                        return root_url + 'mylogs/view/MTL' + '?time=' + new Date().getTime();

                                    }
                                }
                            }
                        })
                        .state('mylogs.clients', {
                            url: '/clients-data',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'My Logs'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        sessionStorage.setItem("page_url", "clients-data");
                                        return root_url + 'mylogs/view/' + sessionStorage.getItem("customer_new") + '?time=' + new Date().getTime();

                                    }
                                }
                            }
                        })

                        .state('mylogs.priority', {
                            url: '/priority-data',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'My Logs'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {

                                        sessionStorage.setItem("page_url", "priority-data");

                                        sessionStorage.setItem("chart_priority", $("#chart_priority").find(".morris-hover-row-label").text());
                                        //console.log($("#chart_priority").find(".morris-hover-row-label").text());
                                        //sessionStorage.getItem("customers");
                                        return root_url + 'mylogs/view/' + $("#chart_priority").find(".morris-hover-row-label").text() + '?time=' + new Date().getTime();

                                    }
                                }
                            }
                        })

                        .state('mylogs.category', {
                            url: '/category-data',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'My Logs'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        sessionStorage.setItem("page_url", "category-data");
                                        sessionStorage.setItem("chart_category", $("#chart_category").find(".morris-hover-row-label").text());
                                        //console.log($("#chart_priority").find(".morris-hover-row-label").text());
                                        //sessionStorage.getItem("customers");
                                        return root_url + 'mylogs/view/' + $("#chart_category").find(".morris-hover-row-label").text() + '?time=' + new Date().getTime();

                                    }
                                }
                            }
                        })
                        .state('mylogs.task', {
                            url: '/task-data',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'My Logs'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        sessionStorage.setItem("page_url", "task-data");

                                        // sessionStorage.setItem("chart_task",$("#chart_task").find("tspan").text().replace(/\d+/g, ''));
                                        sessionStorage.setItem("chart_task", $("#chart_task").find("tspan:eq(0)").text());
                                        //console.log($("#chart_priority").find(".morris-hover-row-label").text());
                                        //sessionStorage.getItem("customers");
                                        return root_url + 'mylogs/view/' + $("#chart_task").find("tspan:eq(0)").text() + '?time=' + new Date().getTime();

                                    }
                                }
                            }
                        })

                        .state('code.list', {
                            url: '/list',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Code  Maintenance'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        return root_url + 'code/list?time=' + new Date().getTime();
                                    }
                                }
                            }
                        })

                        .state('code.edit', {
                            url: '/edit/:id/customer/:customer',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Edit Code'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {

                                        return root_url + 'code/edit/' + $node.id + '/customer/' + $node.customer + '?time=' + new Date().getTime();

                                    }
                                }
                            }
                        })


                        .state('mylogs.editportlet', {
                            url: '/edit-portlets/:id/customer/:customer',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Edit Portlets'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {

                                        return root_url + 'mylogs/edit-portlets/' + $node.id + '/customer/' + $node.customer + '?time=' + new Date().getTime();

                                    }
                                }
                            }

                        })


//                 .state('mylogs.editportl', {
//                            url: '/get-notifications-data',
//                            data: {
//                            },
//                            ncyBreadcrumb: {
//                                label: 'Edit Portlets'
//                            },
//                            views: {
//                                "@": {
//                                    templateUrl: function ($node) {
//
//
//                                        //return root_url + 'mylogs/edit-portlets/' + $node.id + '/customer/' + $node.customer + '?time='+ new Date().getTime()+'&noti=Y';
//                                    }
//                                }
//                            }
//                                   })

//                          .state('mylogs.editportlet', {
//                            url: '/edit-portlets/:id/customer/:customer',
//                            data: {
//                            },
//                            ncyBreadcrumb: {
//                                label: 'Edit Portlets'
//                            },
//                            views: {
//                                "@": {
//                                    templateUrl: function ($node) {

//                                    }
//                                }
//                            }
//                        })





//                          .state('mylogs.editportlet', {
//                            url: '/edit-portlets/:id/customer/:customer',
//                            data: {
//                            },
//                            ncyBreadcrumb: {
//                                label: 'Edit Portlets'
//                            },
//                            views: {
//                                "@": {
//                                    templateUrl: function ($node) {

//                                    }
//                                }
//                            }
//                        })


                        .state('mylogs.error', {
                            url: '/mylogs/error',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'My Logs'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {

                                        return root_url + 'mylogs/error?time=' + new Date().getTime();

                                    }
                                }
                            }
                        })

                        .state('mylogs.editportlet-search', {
                            url: '/edit_portlets/:id/customer/:customer',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Edit Portlets'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {

                                        return root_url + 'mylogs/edit_portlets/' + $node.id + '/customer/' + $node.customer + '?time=' + new Date().getTime();

                                    }
                                }
                            }
                        })


//                          .state('dashboards', {
//                            url: '/dashboard/data',
//                            templateUrl: root_url + 'dashboard/data',
//                            data:{
//                            },
////                            ncyBreadcrumb: {
////                                label: 'Dashboard'
////                            }
//                        })
//                           .state('total_logs', {
//                            url: '/total-logs/all',
//                             templateUrl: root_url+ 'mylogs/list?p_customer_id=FBU',
//                            data:{
//                                
//                            },
////                            ncyBreadcrumb: {
////                                label: 'Dashboard'
////                            }
//                        })
//                         .state('code', {
//                            url: '/code',
//                            abstract: true,
//                            ncyBreadcrumb: {
//                                label: 'Code'
//                            },
//                            data: {
//                                ncyBreadcrumbLabel: 'Code',
//                            }
//                        })
//                        
//                        .state('mylogs', {
//                            url: '/mylogs',
//                            abstract: true,
//                            ncyBreadcrumb: {
//                                label: 'My Logs'
//                            },
//                            data: {
//                                ncyBreadcrumbLabel: 'My Logs',
//                            }
//                        })
//                        
//                        
//                         .state('showusers', {
//                            url: '/showusers',
//                            abstract: true,
//                            ncyBreadcrumb: {
//                                label: 'Show Users'
//                            },
//                            data: {
//                                ncyBreadcrumbLabel: 'Show Users',
//                            }
//                        })
//                        
//                        .state('showusers.list', {
//                            url: '/list',
//                            data: {
//                            },
//                            ncyBreadcrumb: {
//                                label: 'Show Users'
//                            },
//                            views: {
//                                "@": {
//                                    templateUrl: function ($node) {
//                                        return root_url + 'showusers/list?time=' + new Date().getTime();
//                                    }
//                                }
//                            }
//                        })
                        .state('email', {
                            url: '/email',
                            abstract: true,
                            ncyBreadcrumb: {
                                label: 'Email'
                            },
                            data: {
                                ncyBreadcrumbLabel: 'Email',
                            }
                        })
                        .state('email.list', {
                            url: '/list',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'List Email Notification'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        return root_url + 'myemail/list-email?time=' + new Date().getTime();
                                    }
                                }
                            }
                        })

                        .state('email.edit', {
                            url: '/edit/:user_id/customer/:customer',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Edit Email'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {

                                        return root_url + 'myemail/list-email/edit/' + $node.user_id + '/customer/' + $node.customer + '?time=' + new Date().getTime();
                                    }
                                }
                            }
                        })
                        .state('email.delete', {
                            url: '/delete/:cid',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Email Delete'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        return root_url + 'myemail/list-email/delete/' + $node.cid + '?time=' + new Date().getTime();
                                    }
                                }
                            }
                        })
//                        .state('mylogs.list', {
//                            url: '/list',
//                            data: {
//                            },
//                            ncyBreadcrumb: {
//                                label: 'My Logs'
//                            },
//                            views: {
//                                "@": {
//                                    templateUrl: function ($node) {
//                                        return root_url + 'mylogs/list?time=' + new Date().getTime();
//                                    }
//                                }
//                            }
//                        })
//                        
//                        
//                         .state('code.list', {
//                            url: '/list',
//                            data: {
//                            },
//                            ncyBreadcrumb: {
//                                label: 'Code  Maintainance'
//                            },
//                            views: {
//                                "@": {
//                                    templateUrl: function ($node) {
//                                        return root_url + 'code/list?time=' + new Date().getTime();
//                                    }
//                                }
//                            }
//                        })
//                        
//                        .state('code.edit', {
//                            url: '/edit/:id',
//                            data: {
//                            },
//                            ncyBreadcrumb: {
//                                label: 'Edit Code'
//                            },
//                            views: {
//                                "@": {
//                                    templateUrl: function ($node) {
//                                       
//                                        return root_url + 'code/edit/' + $node.id + '?time=' + new Date().getTime();
//                                    }
//                                }
//                            }
//                        })

                        .state('user', {
                            url: '/user',
                            abstract: true,
                            ncyBreadcrumb: {
                                label: 'User'
                            },
                            data: {
                                ncyBreadcrumbLabel: 'Users',
                            }
                        })


//                        .state('user.profile', {
//                            url: '/profile',
//                            resolve: ['$rootScope', function ($rootScope) {
//                                    $rootScope.activePage = 'user_profile';
//                                }],
//                            templateUrl: root_url + 'user_profile',
//                            data: {
//                                pageHeader: '<i class="fa fa-user"></i> My Profile',
//                                ncyBreadcrumbLabel: 'My Profile'
//                            }
//                        })
                        .state('user.change_password', {
                            url: '/change_password',
//                            resolve: ['$rootScope', function ($rootScope) {
//                                    $rootScope.activePage = 'change_password';
//                                }],
                            data: {
                                pageHeader: '<i class="fa fa-key"></i> Change Password',
                                ncyBreadcrumbLabel: 'Change Password'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        return root_url + 'change_password?time=' + new Date().getTime();
                                    }
                                }
                            }
                        })
                        .state('user.list', {
                            url: '/list',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'List Users'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        return root_url + 'users/manage-users?time=' + new Date().getTime();
                                    }
                                }
                            }
                        })
                        .state('user.add', {
                            url: '/add',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Add New User'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        return root_url + 'users/manage-users/add?time=' + new Date().getTime();
                                    }
                                }
                            }
                        })
                        .state('user.edit', {
                            url: '/edit/:id',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Edit User'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        return root_url + 'users/manage-users/edit/' + $node.id + '?time=' + new Date().getTime();
                                    }
                                }
                            }
                        })
                        .state('mylogs.edit', {
                            url: '/edit/:id/customer/:customer',
                            data: {
                            },
                            ncyBreadcrumb: {
                                label: 'Edit MyLogs'
                            },
                            views: {
                                "@": {
                                    templateUrl: function ($node) {
                                        return root_url + 'mylogs/edit/' + $node.id + '/customer/' + $node.customer + '?time=' + new Date().getTime();
                                    }
                                }
                            }
                        })
                        ;
                ThemerProvider = themerProvider;
                themerProvider.setStyles(app_styles);
                themerProvider.setSelected(typeof UserColorTheme != 'undefined' ? UserColorTheme : app_styles[0].key);
            }])
        .constant('dateTimePickerConfig', {
            dropdownSelector: null,
            minuteStep: 5,
            minView: 'minute',
            startView: 'day',
            weekStart: 0
        })
        .directive('autoFocus', function ($timeout) {
            return {
                restrict: 'AC',
                link: function (_scope, _element) {
                    $timeout(function () {
                        _element[0].focus();
                    }, 0);
                }
            };
        })
      
        .factory('ESERVServices', ['$http', function ($http) {
                return {
                    getDashboardStats: function () {
                        return $http.get(root_url + 'getDashboardStats', {
                            params: {
                                ajax_main_loader: false
                            }
                        }).then(function (response) {
                            return response.data;
                        });
                    },
                    getEservNotifications: function () {
                        return $http.get(root_url + 'notificationscount?read=N', {params: {ajax_main_loader: false}}).then(function (response) {
                            return response.data;
                        });
                    },
                };
            }])
        .factory(
                "preloader",
                function ($q, $rootScope) {
                    function Preloader(imageLocations) {
                        this.imageLocations = imageLocations;

                        this.imageCount = this.imageLocations.length;
                        this.loadCount = 0;
                        this.errorCount = 0;

                        this.states = {
                            PENDING: 1,
                            LOADING: 2,
                            RESOLVED: 3,
                            REJECTED: 4
                        };

                        this.state = this.states.PENDING;

                        this.deferred = $q.defer();
                        this.promise = this.deferred.promise;
                    }
                    Preloader.preloadImages = function (imageLocations) {
                        var preloader = new Preloader(imageLocations);
                        return(preloader.load());
                    };
                    Preloader.prototype = {
                        constructor: Preloader,
                        isInitiated: function isInitiated() {
                            return(this.state !== this.states.PENDING);
                        },
                        isRejected: function isRejected() {
                            return(this.state === this.states.REJECTED);
                        },
                        isResolved: function isResolved() {
                            return(this.state === this.states.RESOLVED);
                        },
                        load: function load() {
                            if (this.isInitiated()) {
                                return(this.promise);
                            }
                            this.state = this.states.LOADING;
                            for (var i = 0; i < this.imageCount; i++) {
                                this.loadImageLocation(this.imageLocations[ i ]);
                            }
                            return(this.promise);
                        },
                        handleImageError: function handleImageError(imageLocation) {
                            this.errorCount++;
                            if (this.isRejected()) {
                                return;
                            }
                            this.state = this.states.REJECTED;
                            this.deferred.reject(imageLocation);
                        },
                        handleImageLoad: function handleImageLoad(imageLocation) {
                            this.loadCount++;
                            if (this.isRejected()) {
                                return;
                            }
                            this.deferred.notify({
                                percent: Math.ceil(this.loadCount / this.imageCount * 100),
                                imageLocation: imageLocation
                            });
                            if (this.loadCount === this.imageCount) {
                                this.state = this.states.RESOLVED;
                                this.deferred.resolve(this.imageLocations);
                            }
                        },
                        loadImageLocation: function loadImageLocation(imageLocation) {
                            var preloader = this;
                            var image = $(new Image())
                                    .load(
                                            function (event) {
                                                $rootScope.$apply(
                                                        function () {
                                                            preloader.handleImageLoad(event.target.src);
                                                            preloader = image = event = null;
                                                        }
                                                );
                                            }
                                    )
                                    .error(
                                            function (event) {
                                                $rootScope.$apply(
                                                        function () {
                                                            preloader.handleImageError(event.target.src);
                                                            preloader = image = event = null;
                                                        }
                                                );
                                            }
                                    )
                                    .prop("src", imageLocation)
                                    ;
                        }
                    };
                    return(Preloader);
                }
        )
        ;

ESERV.controller('SortableCTRL', function ($scope) {
    SortableCTRL();
});


function updateNotifications($scope, ESERVServices) {
    $scope.notification_count = '0';
    $scope.all_notifications_data = '0';
    $scope.notification_length = '0';
    ESERVServices.getEservNotifications().then(function (data) {
        // console.log(data);
        $scope.notification_count = data.new_notif_count;
        $scope.all_notifications_data = data.all_notifications;
        $scope.notification_length = (data.all_notifications) ? data.all_notifications.length : data.all_notifications;

    });
}




ESERV.controller('EservemailModalCtrl', ['$scope', '$modal', '$log', 'WEBLOGSServices', '$sce', function ($scope, $modal, $log, WEBLOGSServices, $sce) {

        $scope.openemailEservModal = function (id, header, size, Options) {

            if (typeof Options.close_open_modals != 'undefined') {
                switch (Options.close_open_modals) {
                    case 'all':
                        $scope.$dismiss();
                        break;
                    default:
                        var modals_to_close = Options.close_open_modals.split(',');
                        break;
                }
            }

            var modalInstance = $modal.open({
                templateUrl: 'eservModalContent.html',
                controller: ['$scope', '$modalInstance', '$sce', function ($scope, $modalInstance, $sce) {
                        $scope.modalId = id;
                        $scope.modalHeader = '';
                        $scope.modalBody = 'Loading...';
                        $scope.EservShowModalFooter = false;

                        $scope.modalHeader = header;

                        $scope.ok = function () {
                            $modalInstance.dismiss('cancel');
                        };

                        $scope.cancel = function () {
                            $modalInstance.dismiss('cancel');
                        };

                        WEBLOGSServices.getModalContent(Options.target_url).then(function (response) {
                            if (AJCompile && $scope) {
                                var html_content = AJCompile(response.data + '<div class="clearfix"></div>')($scope);
                                $('#' + $scope.modalId + ' .modal-body').html((typeof html_content != 'undefined' ? html_content : ''));
                            } else {
                                $('#' + $scope.modalId + ' .modal-body').html(response.data + '<div class="clearfix"></div>');
                            }
                            $scope.cancel = function () {
                                $modalInstance.dismiss('cancel');
                            };

                        });
                    }],
                size: size,
                backdrop: 'static',
                keyboard: (typeof (Options.keyboard) != 'undefined') ? Options.keyboard : true
            });
            modalInstance.result.then(function (res) {

            }, function () {
                //$log.info('Modal dismissed at: ' + new Date());
            });
        };
    }]);



ESERV.controller('EservlogsModalCtrl', ['$scope', '$modal', '$log', 'WEBLOGSServices', '$sce', function ($scope, $modal, $log, WEBLOGSServices, $sce) {

        $scope.openlogsEservModal = function (id, header, size, Options) {

            if (typeof Options.close_open_modals != 'undefined') {
                switch (Options.close_open_modals) {
                    case 'all':
                        $scope.$dismiss();
                        break;
                    default:
                        var modals_to_close = Options.close_open_modals.split(',');
                        break;
                }
            }

            var modalInstance = $modal.open({
                templateUrl: 'eservModalContent.html',
                controller: ['$scope', '$modalInstance', '$sce', function ($scope, $modalInstance, $sce) {
                        $scope.modalId = id;
                        $scope.modalHeader = '';
                        $scope.modalBody = 'Loading...';
                        $scope.EservShowModalFooter = false;

                        $scope.modalHeader = header;

                        $scope.ok = function () {
                            $modalInstance.dismiss('cancel');
                        };

                        $scope.cancel = function () {
                            $modalInstance.dismiss('cancel');
                        };

                        WEBLOGSServices.getModalContent(Options.target_url).then(function (response) {
                            if (AJCompile && $scope) {
                                var html_content = AJCompile(response.data + '<div class="clearfix"></div>')($scope);
                                $('#' + $scope.modalId + ' .modal-body').html((typeof html_content != 'undefined' ? html_content : ''));
                            } else {
                                $('#' + $scope.modalId + ' .modal-body').html(response.data + '<div class="clearfix"></div>');
                            }
                            $scope.cancel = function () {
                                $modalInstance.dismiss('cancel');
                            };

                        });
                    }],
                size: size,
                backdrop: 'static',
                keyboard: (typeof (Options.keyboard) != 'undefined') ? Options.keyboard : true
            });
            modalInstance.result.then(function (res) {

            }, function () {
                //$log.info('Modal dismissed at: ' + new Date());
            });
        };
    }]);



ESERV.controller('EservimageModalCtrl', ['$scope', '$modal', '$log', 'WEBLOGSServices', '$sce', function ($scope, $modal, $log, WEBLOGSServices, $sce) {

        $scope.openimageEservModal = function (id, header, size, Options) {

            if (typeof Options.close_open_modals != 'undefined') {
                switch (Options.close_open_modals) {
                    case 'all':
                        $scope.$dismiss();
                        break;
                    default:
                        var modals_to_close = Options.close_open_modals.split(',');
                        break;
                }
            }

            var modalInstance = $modal.open({
                templateUrl: 'eservModalContent.html',
                controller: ['$scope', '$modalInstance', '$sce', function ($scope, $modalInstance, $sce) {
                        $scope.modalId = id;
                        $scope.modalHeader = '';
                        $scope.modalBody = 'Loading...';
                        $scope.EservShowModalFooter = false;

                        $scope.modalHeader = 'Upload File';

                        $scope.ok = function () {
                            $modalInstance.dismiss('cancel');
                        };

                        $scope.cancel = function () {
                            $modalInstance.dismiss('cancel');
                        };

                        WEBLOGSServices.getModalContent(Options.target_url).then(function (response) {
                            if (AJCompile && $scope) {
                                var html_content = AJCompile(response.data + '<div class="clearfix"></div>')($scope);
                                $('#' + $scope.modalId + ' .modal-body').html((typeof html_content != 'undefined' ? html_content : ''));
                            } else {
                                $('#' + $scope.modalId + ' .modal-body').html(response.data + '<div class="clearfix"></div>');
                            }
                            $scope.cancel = function () {
                                $modalInstance.dismiss('cancel');
                            };

                        });
                    }],
                size: size,
                backdrop: 'static',
                keyboard: (typeof (Options.keyboard) != 'undefined') ? Options.keyboard : true
            });
            modalInstance.result.then(function (res) {

            }, function () {
                //$log.info('Modal dismissed at: ' + new Date());
            });
        };
    }]);




var WEBLOGS = angular.module('MTLESERV.WEBLOGS', ['ESERV'])
        .factory('WEBLOGSServices', ['$http', function ($http) {
                return {
                    addMentoToTeacher: function (contact_id) {
                        return $http.get(root_url + 'add_mentor_to_teacher/' + contact_id).then(function (response) {
                            return response.data;
                        });
                    },
                    checkMentorReferenceNo: function (ref) {
                        return $http.get(root_url + 'mentor_check_ref/' + ref).then(function (response) {
                            return response.data;
                        });
                    },
                    confirmGotoUrl: function (url, params) {
                        var req = {
                            method: 'POST',
                            url: url,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            data: {params: typeof params != 'undefined' ? params : {}}
                        }
                        return $http(req).then(function (response) {
                            return response.data;
                        });
                    },
                    getModalContent: function (url) {
                        return $http.get(url, {params: {ajax_main_loader: false}}).then(function (response) {
                            return response;
                        });
                    },
                };

//            }])
//
//        ;


            }])

        ;


//        }])    
//        
//;
/************************search  text script ***********************************************/
WEBLOGS.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 13) {
                scope.$apply(function () {
                    scope.$eval(attrs.ngEnter);
                });

                event.preventDefault();
            }
        });
    };
});
WEBLOGS.controller('Search', function ($window, $scope, $http, productService) {
    $scope.doenter = function () {

//        $("#loading").show();
        toggleMainLoader('Loading...', true);

        var httpRequest = $http({
            method: 'POST',
            data: $.param({id: $scope.search_text}),
            url: root_url + 'mylogs/edit_portlets',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (customer, response) {
//            $("#loading").hide();
            toggleMainLoader(null, false);

            var status = response.status;
            if (customer != 'false')
            {

                $window.location.href = root_url + '#/mylogs/edit-portlets/' + $scope.search_text + '/customer/' + customer + '?time=' + new Date().getTime();
            }
            else
            {
//                $("#error_msg").show();
                DisplayAppAlert('danger', 'This is not a valid request.');
            }
        }).error(function (response) {
            // console.log("error occur");
//            $("#loading").hide();
            toggleMainLoader(null, false);
            DisplayAppAlert('danger', 'An error has occurred!');

//            $("#error_msg").show();
            //$window.location.href=root_url+'#/mylogs/error?time=' + new Date().getTime();

        });

    };
});

/************************************end of script of search *****************************/

WEBLOGS.controller('notification_content', function ($window, $scope, $http) {
    $scope.doClick = function (id, customer) {
        //console.log("afeef");
//          $("#error_msg").hide();
//          $("#loading").show();
        //console.log(id);
        //console.log(customer)
        var httpRequest = $http({
            method: 'POST',
            data: $.param({id: id, customer: customer}),
            url: root_url + 'mylogs/noti_inactive',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (response) {



//     // }).error(function(response) {
//
//    //
//               console.log(response);
//               var status = response.status;
//               //mylogs/error
//           //console.log(customer);
//
            $window.location.href = root_url + '#/mylogs/edit-portlets/' + id + '/customer/' + customer;
//            }).error(function(response) {
//                 console.log("error occur");
//                  $("#loading").hide();
//                  $("#error_msg").show();
////$window.location.href=root_url+'#/mylogs/error?time=' + new Date().getTime();
//
        });

    };
});


WEBLOGS.controller('EservemailConfirmCtrl', ['$scope', '$timeout', '$modal', 'WEBLOGSServices', 'dialogs', function ($scope, $timeout, $modal, WEBLOGSServices, dialogs) {
        $scope.OpenConfirm = function (title, content, size, options, callback_func, goto) {
            var dlg = dialogs.confirm(title, content, size);
            dlg.result.then(function (btn) {
//                $('#eserv_main_loader').show();
                toggleMainLoader('Loading...', true);
                if (typeof options != 'undefined') {
                    if (typeof options.type != 'undefined') {
                        switch (options.type) {
                            case 'url':
                                var urlParams = {};
                                if (typeof options.extra_field_params != 'undefined') {
                                    for (var i in options.extra_field_params) {
                                        var param = options.extra_field_params[i];
                                        switch (param.type) {
                                            case 'array':
                                                var tmpArray = [];
                                                $(param.field_name).each(function () {
                                                    tmpArray.push($(this).val());
                                                });
                                                urlParams[i] = tmpArray.join(',');
                                                break;
                                            default:
                                                break;
                                        }
                                    }
                                }
                                WEBLOGSServices.confirmGotoUrl(options.url, {'params': urlParams}).then(function (res) {
                                    if (res.success) {
                                        if (typeof options.close_modals != 'undefined') {
                                            switch (options.close_modals) {
                                                case 'all':
                                                    $timeout(function () {
                                                        $('.modal-header .close').click();
                                                        if (typeof options.dataTable_id != 'undefined') {
                                                            $('#' + options.dataTable_id).dataTable().fnReloadAjax();
                                                        }
                                                    });
                                                    break;
                                                case 'current':
                                                    $timeout(function () {
                                                        if (typeof options.close_button_id != 'undefined') {
                                                            $('#' + options.close_button_id).click();
                                                        }
                                                        if (typeof options.dataTable_id != 'undefined') {
                                                            $('#' + options.dataTable_id).dataTable().fnReloadAjax();
                                                        }
                                                    });
                                                    break;
                                                default:
                                                    if (typeof options.dataTable_id != 'undefined') {
                                                        $('#' + options.dataTable_id).dataTable().fnReloadAjax();
                                                    }
                                                    break;
                                            }
                                        }

                                        if (typeof options.refresh_portlet != 'undefined') {
                                            switch (options.refresh_portlet) {
                                                case 'current':
                                                    $timeout(function () {
                                                        if (typeof options.portlet_id != 'undefined') {
                                                            refreshProtlet($('#' + options.portlet_id));
                                                        }
                                                    });
                                                    break;
                                            }
                                        }

                                        if (eval("typeof " + callback_func + " == 'function'")) {
                                            eval(callback_func + "(res)");
                                        }

                                        if (typeof goto != 'undefined') {
                                            window.location.replace(root_url + goto);
                                        }

                                        DisplayAppAlert('success', res.msg);
                                    } else {
                                        DisplayAppAlert('danger', res.msg, typeof options.form_id != 'undefined' ? options.form_id : undefined, false);
                                    }
                                });
                                break;
                        }
                    }
                }
            }, function (btn) {

            });
        };
    }]);


WEBLOGS.controller('EservConfirmCtrl', ['$scope', '$timeout', '$modal', 'WEBLOGSServices', 'dialogs', function ($scope, $timeout, $modal, WEBLOGSServices, dialogs) {
        $scope.OpenConfirm = function (title, content, size, options, callback_func, goto) {
            var dlg = dialogs.confirm(title, content, size);
            dlg.result.then(function (btn) {
//                $('#eserv_main_loader').show();
                toggleMainLoader('Loading...', true);
                if (typeof options != 'undefined') {
                    if (typeof options.type != 'undefined') {
                        switch (options.type) {
                            case 'url':
                                var urlParams = {};
                                if (typeof options.extra_field_params != 'undefined') {
                                    for (var i in options.extra_field_params) {
                                        var param = options.extra_field_params[i];
                                        switch (param.type) {
                                            case 'array':
                                                var tmpArray = [];
                                                $(param.field_name).each(function () {
                                                    tmpArray.push($(this).val());
                                                });
                                                urlParams[i] = tmpArray.join(',');
                                                break;
                                            default:
                                                break;
                                        }
                                    }
                                }
                                WEBLOGSServices.confirmGotoUrl(options.url, {'params': urlParams}).then(function (res) {
                                    if (res.success) {
                                        if (typeof options.close_modals != 'undefined') {
                                            switch (options.close_modals) {
                                                case 'all':
                                                    $timeout(function () {
                                                        $('.modal-header .close').click();
                                                        if (typeof options.dataTable_id != 'undefined') {
                                                            $('#' + options.dataTable_id).dataTable().fnReloadAjax();
                                                        }
                                                    });
                                                    break;
                                                case 'current':
                                                    $timeout(function () {
                                                        if (typeof options.close_button_id != 'undefined') {
                                                            $('#' + options.close_button_id).click();
                                                        }
                                                        if (typeof options.dataTable_id != 'undefined') {
                                                            $('#' + options.dataTable_id).dataTable().fnReloadAjax();
                                                        }
                                                    });
                                                    break;
                                                default:
                                                    if (typeof options.dataTable_id != 'undefined') {
                                                        $('#' + options.dataTable_id).dataTable().fnReloadAjax();
                                                    }
                                                    break;
                                            }
                                        }

                                        if (typeof options.refresh_portlet != 'undefined') {
                                            switch (options.refresh_portlet) {
                                                case 'current':
                                                    $timeout(function () {
                                                        if (typeof options.portlet_id != 'undefined') {
                                                            refreshProtlet($('#' + options.portlet_id));
                                                        }
                                                    });
                                                    break;
                                            }
                                        }

                                        if (eval("typeof " + callback_func + " == 'function'")) {
                                            eval(callback_func + "(res)");
                                        }

                                        if (typeof goto != 'undefined') {
                                            window.location.replace(root_url + goto);
                                        }

                                        DisplayAppAlert('success', res.msg);
                                    } else {
                                        DisplayAppAlert('danger', res.msg, typeof options.form_id != 'undefined' ? options.form_id : undefined, false);
                                    }
                                });
                                break;
                        }
                    }
                }
            }, function (btn) {

            });
        };
    }]);


//MIS added script for graphs //
function rekey(arr, lookup) {
    for (var i = 0; i < arr.length; i++) {
        var obj = arr[i];
        for (var fromKey in lookup) {
            var toKey = lookup[fromKey];
            var value = obj[fromKey];
            if (value) {
                obj[toKey] = value;
                delete obj[fromKey];
            }
        }
    }
    return arr;
}
//use service in angular js to tranfer data from one controller to another//
WEBLOGS.service('productService', function () {
    var productList = [];
    var addProduct = function (newObj) {
        productList.push(newObj);
        Object.keys(subs).forEach(function (k) {
            subs[k](productList);
        });
    };
    var getProducts = function () {
        return productList;
    };
    var subs = {};
    return {
        addProduct: addProduct,
        getProducts: getProducts,
        sub: sub, unsub: unsub
    };
    function sub(id, handler) {
        subs[id] = handler;
    }
    function unsub(id) {
        delete subs[id];
    }
});

// //MIS added script for graphs //
////        function rekey(arr, lookup) {
////        for (var i = 0; i < arr.length; i++) {
////        var obj = arr[i];
////        for (var fromKey in lookup) {
////        var toKey = lookup[fromKey];
////        var value = obj[fromKey];
////        if (value) {
////        obj[toKey] = value;
////        delete obj[fromKey];
////        }
////        }
////        }
////        return arr;
////                        }
////        //use service in angular js to tranfer data from one controller to another//
////        WEBLOGS.service('productService', function() {
////					var productList = [];
////					var addProduct = function(newObj) {
////					productList.push(newObj);
////					Object.keys(subs).forEach(function(k){
////					subs[k](productList);
////					});
////					};
////					var getProducts = function(){
////					return productList;
////					};
////					var subs = {};
////					return {
////					addProduct: addProduct,
////					getProducts: getProducts,
////					sub: sub, unsub: unsub
////					};
////					function sub(id, handler) { subs[id] = handler; }
////					function unsub(id) {delete subs[id]; }
////			});
////			 
//        
//        
//        
//        //end of service //
//        var flag=false;   
//			//mylogsController  controller //
//			WEBLOGS.controller('mylogsController', function($scope,$http,productService){
//						var httpRequest = $http({
//						method: 'GET',
//						url: root_url+'customer',
//						}).success(function(customers, status) {
//						console.log(status);
//						if(status==200)
//						{
//						flag_customers=status;
//						}
//						$.each(customers, function(key, value) {
//						$('#customer_id')
//						.append($("<option></option>")
//						.attr("value",value.customerId)
//						.text(value.name)); 
//						});
//						//
//						});
//						var httpRequest = $http({
//						method: 'GET',
//						url: root_url+'mylogs-assignedto',
//						}).success(function(assignedto, status) {
//						console.log(assignedto);
//						$.each(assignedto, function(key, value) {
//						//console.log(value.assigned_to);
//						$('#p_contact_search')
//						.append($("<option></option>")
//						.attr("value",value.person_id)
//						.text(value.full_name)); 
//						});
//						//
//						});
//						$("#new_log_bt").click(function()
//						{
//						$("#modal_new_log").show();
//						//alert("testing");
//						});
//                                                
//						$("#search_bt").click(function()
//						{
//						//define scope
//						$scope.userData={
//						log_no:"default",
//						customer_id:"default",
//						customerlog_id:"default",
//						logs_displayed:"default",
//						keyword:"default",
//						p_contact_search:"default"
//						};
//						//{username: $scope.userName, password: $scope.password}
//						//var current_logs=$("#search_form").serialize();
//						var data=$scope.user;
//						//                                        $scope.submitForm=function(){
//						var httpRequest = $http({
//						method: 'POST',
//						data: $.param( data),
//						url: root_url+'display_current_logs',
//						headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//						}).success(function(currentlogs, status) {
//						console.log(currentlogs);
//						});
//						
//						});
//			
//			});
//        
//        
//        
//        
//        			//chapter controller //
//			WEBLOGS.controller('chapter', function($scope,$http,productService){
//					$scope.change = function () {
//					console.log($scope.value);
//					flag=true;
//					var data = $scope.value;
//					var httpRequest = $http({
//					method: 'POST',
//					data: $.param({customers: data}),
//					url: 'http://localhost/weblogs-s2/web/weblogs_dev.php/listdata',
//					headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//					}).success(function(customers, status) {
//					
//					});
//					
//					}
//			});
//			//parentController controller //
//			WEBLOGS.controller('parentController', function($scope,$http,productService){
//						$scope.change = function () {
//						console.log($scope.value);
//						flag=true;
//						if($("#chart_task").children()[0])
//						{
//						angular.element( document.querySelector( '#chart_task svg' ) ).remove();
//						}
//						if($("#chart_category").children()[0])
//						{
//						angular.element( document.querySelector( '#chart_category svg' ) ).remove();
//						}
//						if($("#chart_priority").children()[0])
//						{
//						angular.element( document.querySelector( '#chart_priority svg' ) ).remove();
//						}
//						productService.addProduct($scope.value);
//						var data = $scope.value;
//						var httpRequest = $http({
//						method: 'POST',
//						data: $.param({customers: data}),
//						url: root_url+'customersave',
//						headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//						}).success(function(customers, status) {
//						});
//						
//						}
//			});
//                        //countCtrl controller //
//			WEBLOGS.controller('countCtrl', function($scope,$http,$q,productService){
//					var flag_customers=false;  
//					var httpRequest = $http({
//					method: 'GET',
//					url: root_url+'customers',
//					}).success(function(customers, status) {
//					console.log(status);
//					if(status==200)
//					{
//					flag_customers=status;
//					}
//					$.each(customers, function(key, value) {
//					$('#p_client_main')
//					.append($("<option></option>")
//					.attr("value",value.customerId)
//					.text(value.name));
//					});
//			//
//			});
//                                        angular.element(document).ready(function () {
//                        						//function EntryCtrl ($scope, $http) {
//						var randown_string=Math.random();
//						var p_user_id=sessionStorage.getItem("userid");
//						//var p_user_id=$("#customer").val();
//						var customer=$("#p_client_main :selected").val();
//						$scope.ress= [];
//						$scope.res= [];
//						$scope.res1= [];
//						$scope.res2= [];
//						$scope.res3= [];
//						$scope.barchart_category= [];
//						//       $scope.itm= [];
//						var productLists=[];
//						$scope.items = productService.getProducts();
//						//      if($scope.items!='')
//						//      {
//						productService.sub('logger', function(list){
//						console.log(list);
//                                                console.log("afeef");
//						//             $scope.itm.push(list);
//						var arrlength=list.length;
//						var secondlist=arrlength-1;
//						var task_chart = list.slice(secondlist,arrlength);
//						// appending data in dropdown //
//						//end of code //
//						var httpRequest = $http({
//						method: 'GET',
//						url: root_url+'prioritycount?p_customer_id='+task_chart+'&p_random='+randown_string+'',
//						}).success(function(json3, status) {
//						$scope.res3=json3.data;
//						Morris.Bar({
//						element: 'chart_priority',
//						data: json3.data,// use returned data to plot the graph,
//						xkey: 'priority',
//						ykeys: ['value'],
//						labels: ['Logs'],
//						hideHover: 'auto',
//						//
//						});
//						}); 
//						var httpRequest = $http({
//						method: 'GET',
//						url: root_url+'taskcount?p_customer_id='+task_chart+'&p_random='+randown_string+'',
//						headers: {
//						'Content-type': 'application/json'
//						},
//						}).success(function(json, status) {
//						//console.log(json);
//						$scope.ress= json;
//						var converted = rekey(json.data, {data: 'value' });
//						//console.log(converted);
//						$scope.ress=converted;
//						Morris.Donut({
//						element: 'chart_task',
//						data: converted // use returned data to plot the graph
//						});
//						});
//						var httpRequest = $http({
//						method: 'GET',
//						url: root_url+'logsdashboard?p_customer_id='+task_chart+'&p_random='+randown_string+'&p_user_id='+p_user_id+'&p_staff=Y',
//						}).success(function(data, status) {
//						$scope.to_client=data.data[0].to_client;
//						$scope.open_logs=data.data[0].open_logs;
//						$scope.to_mtl=data.data[0].to_mtl;
//						$("#to_client").html($scope.to_client);
//						$("#open_logs").html($scope.open_logs);
//						$("#to_mtl").html($scope.to_mtl);
//						});
//						var httpRequest = $http({
//						method: 'GET',
//						url: root_url+'categorycount?p_customer_id='+task_chart+'&p_random='+randown_string+'',
//						}).success(function(json2, status) {
//						$scope.barchart_category=json2.data;
//						Morris.Bar({
//						element: 'chart_category',
//						data: json2.data,// use returned data to plot the graph,
//						xkey: 'category',
//						ykeys: ['value'],
//						labels: ['Logs'],
//						hideHover: 'auto',
//						resize: true
//						//
//						});
//						});
//					});
//					$scope.$on('$destroy', function(){
//					productService.unsub('logger');
//					});
//					
//                                        if(flag==false )
//					{
//                                            
//					var httpRequest = $http({
//					method: 'GET',
//					url: root_url+'show-customers',
//					}).success(function(customers, status) {
//					console.log(customers);
//					//                    if(status==200)
//					//                 {
//					//                 flag_customers=status;
//					//             }
//					$("#last_customer_select").attr("value",customers);
//					if($("#last_customer_select").val()!='')
//					{
//					//$('#p_client_main').append($("<option value="+$("#last_customer_select").val()+"></option>").prop("selected", true));
//					//$('#p_client_main option[value='+ customers + ']').prop("selected", true);
//					$('select option[value=' + $("#last_customer_select").val() +']').prop("selected", true);
//					}
//					//});
//					var customer_id= $("#last_customer_select").val();
//					console.log(customer_id);
//					var httpRequest = $http({
//					method: 'GET',
//					url: root_url+'prioritycount?p_customer_id='+customer_id+'&p_random='+randown_string+'',
//					}).success(function(json3, status) {
//					$scope.res3=json3.data;
//					Morris.Bar({
//					element: 'chart_priority',
//					data: json3.data,// use returned data to plot the graph,
//					xkey: 'priority',
//					ykeys: ['value'],
//					labels: ['Logs'],
//					hideHover: 'auto',
//					//
//					});
//					});
//					var httpRequest = $http({
//					method: 'GET',
//					url: root_url+'categorycount?p_customer_id='+customer_id+'&p_random='+randown_string+'',
//					}).success(function(json2, status) {
//					$scope.barchart_category=json2.data;
//					Morris.Bar({
//					element: 'chart_category',
//					data: json2.data,// use returned data to plot the graph,
//					xkey: 'category',
//					ykeys: ['value'],
//					labels: ['Logs'],
//					hideHover: 'auto',
//					resize: true
//					//
//					});
//					});
//					var httpRequest = $http({
//					method: 'GET',
//					url: root_url+'taskcount?p_customer_id='+customer_id+'&p_random='+randown_string+'',
//					headers: {
//					'Content-type': 'application/json'
//					},
//					}).success(function(json, status) {
//					//console.log(json);
//					$scope.ress= json;
//					var converted = rekey(json.data, {data: 'value' });
//					//console.log(converted);
//					$scope.ress=converted;
//					Morris.Donut({
//					element: 'chart_task',
//					data: converted // use returned data to plot the graph
//					});
//					});
//					var httpRequest = $http({
//					method: 'GET',
//					url: root_url+'show-userid',
//					}).success(function(customers, status) {
//					$("#customer").attr("value",customers);
//					var httpRequest = $http({
//					method: 'GET',
//					url: root_url+'logsdashboard?p_customer_id='+customer_id+'&p_random='+randown_string+'&p_user_id='+$("#customer").val()+'&p_staff=Y',
//					}).success(function(data, status) {
//					$scope.to_client=data.data[0].to_client;
//					$scope.open_logs=data.data[0].open_logs;
//					$scope.to_mtl=data.data[0].to_mtl;
//					$("#to_client").html($scope.to_client);
//					$("#open_logs").html($scope.open_logs);
//					$("#to_mtl").html($scope.to_mtl);
//					});
//					});///xhr request closure
//					});
//					}
//					});
//					});
//					
//					//countCtrl1 controller //
//			WEBLOGS.controller('countCtrl1', function($scope,$http,$q,productService){
//					angular.element(document).ready(function () {
//					$scope.res= [];
//					$scope.res1= [];
//					$scope.res2= [];
//					$scope.items = productService.getProducts();
//					//      if($scope.items!='')
//					//      {
//					productService.sub('logger', function(list){
//					console.log(list);
//					//             $scope.itm.push(list);
//					var arrlength=list.length;
//					var secondlist=arrlength-1;
//					var task_chart = list.slice(secondlist,arrlength);
//					console.log(task_chart);
//					console.log("aaaa");   
//					//angular.element( document.querySelector( '#chart_task svg' ) ).remove();
//					});
//					$scope.$on('$destroy', function(){
//					productService.unsub('logger');
//					});
//					});
//			});
//			//countCtrl2 controller //
////			WEBLOGS.controller('countCtrl2', function($scope,$http,$q){
////						angular.element(document).ready(function () {
////						$scope.res= [];
////						var httpRequest = $http({
////						method: 'GET',
////						url: 'http://cors.io/?u= http://www.mtl.uk.net/pls/logsheets/wwv_json_data.category_chart?p_customer_id=ACP&p_random=0.6006743305186666"',
////						}).success(function(json2, status) {
////						$scope.res=json2.data;
////						Morris.Bar({
////						element: 'chart_category',
////						data: json2.data,// use returned data to plot the graph,
////						xkey: 'category',
////						ykeys: ['value'],
////						labels: ['Logs'],
////						hideHover: 'auto',
////						resize: true
////						//
////						});
////						});
////						});
////			});
//			//countCtrl3 controller //
////			WEBLOGS.controller('countCtrl3', function($scope,$http,$q){
////					angular.element(document).ready(function () {
////					$scope.res= [];
////					var httpRequest = $http({
////					method: 'GET',
////					url: 'http://cors.io/?u=http://www.mtl.uk.net/pls/logsheets/wwv_json_data.priority_chart?p_customer_id=ACP&p_random=0.9410924760088444"',
////					}).success(function(json3, status) {
////					$scope.res=json3.data;
////					Morris.Bar({
////					element: 'chart_priority',
////					data: json3.data,// use returned data to plot the graph,
////					xkey: 'priority',
////					ykeys: ['value'],
////					labels: ['Logs'],
////					hideHover: 'auto',
////					//
////					});
////					});
////					});
////			});
//			//EntryCtrl controller//
//			WEBLOGS.controller('EntryCtrl', function($scope, $http, $sce){
//			$scope.response=[];
//			var obj = {};
//			obj.getResponse = function(){                
//			var temp = {};
//			var defer = $q.defer();
//			$http.get(root_url+'users/manage-users').success(function(data){
//			$scope.response = $sce.trustAsHtml(data);
//			temp =data;
//			defer.resolve(data);
//			});
//			return defer.promise;
//			}
//			})
//        
//        //end of script//
//>>>>>>> .r59




//end of service //
var flag = false;
//mylogsController  controller //
WEBLOGS.controller('mylogsController', function ($scope, $http, productService) {
    
   
    var httpRequest = $http({
        method: 'GET',
        url: root_url + 'customer',
    }).success(function (customers, status) {
        //  console.log(status);
        if (status == 200)
        {
            flag_customers = status;
        }
        $.each(customers, function (key, value) {

            $('#customer_id')
                    .append($("<option></option>")
                            .attr("value", value.customerId)
                            .text(value.name));
        });
//          var httpRequest = $http({
//                method: 'GET',
//                url: root_url + 'show-customers',
//            }).success(function (customers, status) {
//        
////                   });
//                if(customers!='' && customers!=undefined)
//                {
//                    $('#p_client_main').val(customers);
//                }
//                
//            });
        //
    });
    var httpRequest = $http({
        method: 'GET',
        url: root_url + 'mylogs-assignedto',
    }).success(function (assignedto, status) {
        // console.log(assignedto);
        $.each(assignedto, function (key, value) {
            //console.log(value.assigned_to);
            $('#p_contact_search')
                    .append($("<option></option>")
                            .attr("value", value.person_id)
                            .text(value.full_name));
        });
        //
    });
//  
//    $("#search_bt").click(function ()
//    {
//        //define scope
//        $scope.userData = {
//            log_no: "default",
//            customer_id: "default",
//            customerlog_id: "default",
//            logs_displayed: "default",
//            keyword: "default",
//            p_contact_search: "default"
//        };
//        //{username: $scope.userName, password: $scope.password}
//        //var current_logs=$("#search_form").serialize();
//        var data = $scope.user;
//        //                                        $scope.submitForm=function(){
//        var httpRequest = $http({
//            method: 'POST',
//            data: $.param(data),
//            url: root_url + 'display_current_logs',
//            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//        }).success(function (currentlogs, status) {
//            console.log(currentlogs);
//        });
//
//    });

});




//chapter controller //
WEBLOGS.controller('chapter', function ($scope, $http, productService) {
    $scope.change = function () {
        // console.log($scope.value);
        flag = true;
        var data = $scope.value;
        var httpRequest = $http({
            method: 'POST',
            data: $.param({customers: data}),
            url: root_url + 'listdata',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (customers, status) {

        });

    }
});
//parentController controller //
WEBLOGS.controller('parentController', function ($scope, $http, productService) {

    //check staff y or n

    $scope.change = function () {
        //console.log($scope.value);
//        $("#loading").show();
        toggleMainLoader('Loading...', true);
        sessionStorage.setItem("customer_new", $scope.value);
        flag = true;

        $("#client").html($scope.value);
        if (document.querySelector('#chart_category div') != null)
        {
            document.querySelector('#chart_category div').remove();
        }
//            if($("#chart_task").find("svg").length >1 )
//            {
//                
//                 angular.element(document.querySelector('#chart_task svg')).remove();
//            }
        if (document.querySelector('#chart_priority div') != null)
        {
            document.querySelector('#chart_priority div').remove();
        }


        if ($("#chart_task").children()[0])
        {
            //console.log("chart_task");
            angular.element(document.querySelector('#chart_task svg')).remove();
        }
        if ($("#chart_category").children()[0])
        {
            angular.element(document.querySelector('#chart_category svg')).remove();
        }

        if ($("#chart_priority").children()[0])
        {
            angular.element(document.querySelector('#chart_priority svg')).remove();
        }
        productService.addProduct($scope.value);
        var data = $scope.value;
        var httpRequest = $http({
            method: 'POST',
            data: $.param({customers: data}),
            url: root_url + 'customersave',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (customers, status) {
            sessionStorage.getItem($scope.value);
        });

    }
});
//countCtrl controller //
WEBLOGS.controller('countCtrl', function ($scope, $http, $q, productService, $window) {

    var flag_customers = false;
    var httpRequest = $http({
        method: 'GET',
        url: root_url + 'customers',
    }).success(function (customers, status) {
        // console.log("customers count ctrl");

        //  console.log(status);
        if (status == 200)
        {
            flag_customers = status;
        }
        $.each(customers, function (key, value) {
            //$("#p_client_main").html($("<option value="+value.customerId+">"+value.name+"</option>"));
            $('#p_client_main')
                    .append($("<option></option>")
                            .attr("value", value.customerId)
                            .text(value.name));
        });
        var httpRequest = $http({
            method: 'GET',
            url: root_url + 'show-customers',
        }).success(function (customers, status) {

//                   });
            sessionStorage.setItem("customer_new", customers);
            if (customers != '' && customers != undefined)
            {
                $('#p_client_main').val(customers);
            }

        });

//       
//                                        $scope.RedirectToURL = function() {
//                                            console.log(this.href);
//                                         // var host = $window.location.host;
//                                          var landingUrl =this.href; 
//                                         // alert(landingUrl);
//                                          $window.location.href = landingUrl;
//                                        };
        //
    });
    angular.element(document).ready(function () {
        //function EntryCtrl ($scope, $http) {
        var randown_string = Math.random();
        var p_user_id = sessionStorage.getItem("userid");
        //var p_user_id=$("#customer").val();
        // var customer = $("#p_client_main :selected").val();
        $scope.ress = [];
        $scope.res = [];
        $scope.res1 = [];
        $scope.res2 = [];
        $scope.res3 = [];
        $scope.barchart_category = [];
        //       $scope.itm= [];
        var productLists = [];
        $scope.items = productService.getProducts();
        //      if($scope.items!='')
        //      {
        productService.sub('logger', function (list) {


            //check staff flag is y or n
            // var staff=sessionStorage.getItem("staff");
            //  console.log(list);

            //             $scope.itm.push(list);
            var arrlength = list.length;
            var secondlist = arrlength - 1;
            var task_chart = list.slice(secondlist, arrlength);
            sessionStorage.setItem("customer_new", task_chart);
            // appending data in dropdown //
            //end of code //
            var httpRequest = $http({
                method: 'GET',
                url: root_url + 'prioritycount?p_customer_id=' + task_chart + '&p_random=' + randown_string,
            }).success(function (json3, status) {
                $scope.res3 = json3.data;

                //console.log(json3.length);
                //console.log(json3.data)
                if (json3.length == 0 || json3.data == undefined)
                {
                    //alert("data undefined");
                    $("#chart_priority").parent().attr("class", "hide");
                    $("#prioritys").show();
                    var priority_graph = [{label: "Logs", value: 0}];


                }
                else
                {
                    $("#chart_priority").parent().attr("class", "show");
                    $("#prioritys").hide();
                    var priority_graphs = json3.data;


                }
                Morris.Bar({
                    element: 'chart_priority',
                    data: json3.data ? priority_graphs : priority_graph, // use returned data to plot the graph,
                    //data:json3.data, // use returned data to plot the graph,
                    xkey: 'priority',
                    ykeys: ['value'],
                    labels: ['Logs'],
                    hideHover: 'auto',
                    xLabelAngle: 20,
                    resize: true,
                    //
                });
            });
            var httpRequest = $http({
                method: 'GET',
                url: root_url + 'taskcount?p_customer_id=' + task_chart + '&p_random=' + randown_string,
                headers: {
                    'Content-type': 'application/json'
                },
            }).success(function (json, status) {
                //console.log(json.data);
                $scope.ress = json;

                if (json.data != undefined)
                {
                    var converted = rekey(json.data, {data: 'value'});
                    $("#chart_task").parent().attr("class", "show");
                    $("#task").hide();
                }
                else
                {
                    var converted = [{label: "No DATA", data: "0"}];
                    $("#chart_task").parent().attr("class", "hide");
                    $("#task").show();

                }
                //console.log(converted);
                $scope.ress = converted;
                Morris.Donut({
                    element: 'chart_task',
                    data: converted // use returned data to plot the graph
                });
            });
//             var httpRequest = $http({
//             method: 'GET',
//             url: root_url + 'check_staff',
//            }).success(function (staff, status) {
//               // console.log(staff);
//                //console.log("staff_verify");
//                sessionStorage.setItem("staff", staff);


            var httpRequest = $http({
                method: 'GET',
                //url: root_url + 'logsdashboard?p_customer_id=' + task_chart + '&p_random=' + randown_string + '&p_user_id=' + p_user_id + '&p_staff='+staff,
                url: root_url + 'logsdashboard?p_customer_id=' + task_chart + '&p_random=' + randown_string + '&p_user_id=' + p_user_id,
            }).success(function (data, status) {
                $scope.to_client = data.data[0].to_client;
                $scope.open_logs = data.data[0].open_logs;
                $scope.to_mtl = data.data[0].to_mtl;
                $("#to_client").html($scope.to_client);
                $("#open_logs").html($scope.open_logs);
                $("#to_mtl").html($scope.to_mtl);
//                $("#loading").hide();
                toggleMainLoader(null, false);
            });
            //});
            var httpRequest = $http({
                method: 'GET',
                url: root_url + 'categorycount?p_customer_id=' + task_chart + '&p_random=' + randown_string,
            }).success(function (json2, status) {
                $scope.barchart_category = json2.data;
                // console.log(json2.data.length);
                if (json2.length == 0 || json2.data == undefined)
                {
                    $("#chart_category").parent().attr("class", "hide");
                    $("#category").show();
                    var category_graph = [{label: "Logs", value: 0}];


                }
                else
                {
                    $("#chart_category").parent().attr("class", "show");
                    $("#category").hide();

                    var category_graphs = json2.data;


                }

                Morris.Bar({
                    element: 'chart_category',
                    data: json2.data ? category_graphs : category_graph, // use returned data to plot the graph,
                    //data: datas, // use returned data to plot the graph,
                    xkey: 'category',
                    ykeys: ['value'],
                    labels: ['Logs'],
                    hideHover: 'auto',
                    resize: true,
                    xLabelAngle: 20
                            //
                });
            });
        });
        $scope.$on('$destroy', function () {
            productService.unsub('logger');
        });

        // if (flag == false)
        // {
        // alert("falsg false");
        //console.log("sdffgd");

        //check staff flag is y or n
        // var staff=sessionStorage.getItem("staff");
          

        var httpRequest = $http({
            method: 'GET',
            url: root_url + 'show-customers',
        }).success(function (customers, status) {

            sessionStorage.setItem("customer_new", customers);
            // $('#p_client_main').val(sessionStorage.getItem("customer_new"));

            var customer_id = sessionStorage.getItem("customer_new");
            // $('#p_client_main option[value='+ customer_id +']').attr("selected","selected");
            if (customer_id != '')
            {
                $("#client").html(customer_id);
            }


            //total open logs//
            $("#chart_priority").find(".morris-hover").attr("ui-sref='mylogs.priority'");
            var httpRequest = $http({
                method: 'GET',
                url: root_url + 'prioritycount?p_customer_id=' + customer_id + '&p_random=' + randown_string,
            }).success(function (json3, status) {
                $scope.res3 = json3.data;

                // console.log(json3.length);
                //console.log(json3.data);
                if (json3.length == 0 || json3.data == undefined)
                {
                    // alert("data undefined");
                    $("#chart_priority").parent().attr("class", "hide");
                    $("#prioritys").hide();
                    var priority_graph = [{label: "Logs", value: 0}];
                }
                else
                {
                    $("#chart_priority").parent().attr("class", "show");

                    var priority_graphs = json3.data;

                }
                Morris.Bar({
                    element: 'chart_priority',
                    data: json3.data ? priority_graphs : priority_graph,
                    xkey: 'priority',
                    ykeys: ['value'],
                    labels: ['Logs'],
                    xLabelAngle: 20,
                    hideHover: 'auto',
                    resize: true,
                });
                // sessionStorage.setItem("priority", customers);

            });

            var httpRequest = $http({
                method: 'GET',
                url: root_url + 'categorycount?p_customer_id=' + customer_id + '&p_random=' + randown_string,
            }).success(function (json2, status) {
                $scope.barchart_category = json2.data;

                if (json2.length == 0 || json2.data == undefined)
                {
                    $("#chart_category").parent().attr("class", "hide");
                    $("#category").show();
                    var category_graph = [{label: "Logs", value: 0}];

                }
                else
                {
                    $("#chart_category").parent().attr("class", "show");
                    $("#category").hide();
                    var category_graphs = json2.data;
                }

                Morris.Bar({
                    element: 'chart_category',
                    data: json2.data ? category_graphs : category_graph,
                    xkey: 'category',
                    ykeys: ['value'],
                    labels: ['Logs'],
                    resize: true,
                    xLabelAngle: 20

                            //
                });
            });
            var httpRequest = $http({
                method: 'GET',
                url: root_url + 'taskcount?p_customer_id=' + customer_id + '&p_random=' + randown_string,
                headers: {
                    'Content-type': 'application/json'
                },
            }).success(function (json, status) {
                //console.log(json.data);
                $scope.ress = json;
                if (json.data != undefined)
                {
                    var converted = rekey(json.data, {data: 'value'});
                    $("#chart_task").parent().attr("class", "show");
                    $("#task").hide();

                }
                else
                {
                    var converted = [{label: "No DATA", data: "0"}];
                    $("#chart_task").parent().attr("class", "hide");
                    $("#task").show();
                }
                //console.log(converted);
                $scope.ress = converted;
                Morris.Donut({
                    element: 'chart_task',
                    data: converted // use returned data to plot the graph
                });
            });

            //                            var httpRequest = $http({
            //                            method: 'GET',
            //                            url: root_url + 'check_staff',
            //                            }).success(function (staff, status) {
            var httpRequest = $http({
                method: 'GET',
                url: root_url + 'show-userid',
            }).success(function (customer, status) {
                $("#customer").attr("value", customer);
                //alert(staff);
                var httpRequest = $http({
                    method: 'GET',
                    //  url: root_url + 'logsdashboard?p_customer_id=' + customers + '&p_random=' + randown_string + '&p_user_id=' + $("#customer").val() + '&p_staff='+staff,
                    url: root_url + 'logsdashboard?p_customer_id=' + customer_id + '&p_random=' + randown_string + '&p_user_id=' + $("#customer").val(),
                }).success(function (data, status) {
                    $scope.to_client = data.data[0].to_client;
                    $scope.open_logs = data.data[0].open_logs;
                    $scope.to_mtl = data.data[0].to_mtl;
                    $("#to_client").html($scope.to_client);
                    $("#open_logs").html($scope.open_logs);
                    $("#to_mtl").html($scope.to_mtl);
                });
            });///xhr request closure
        });

        //  });
        // }
    });
});

//countCtrl1 controller //
WEBLOGS.controller('countCtrl1', function ($scope, $http, $q, productService) {
    angular.element(document).ready(function () {
        $scope.res = [];
        $scope.res1 = [];
        $scope.res2 = [];
        $scope.items = productService.getProducts();
        //      if($scope.items!='')
        //      {
        productService.sub('logger', function (list) {
            // console.log(list);
            //             $scope.itm.push(list);
            var arrlength = list.length;
            var secondlist = arrlength - 1;
            var task_chart = list.slice(secondlist, arrlength);
            //console.log(task_chart);

            //angular.element( document.querySelector( '#chart_task svg' ) ).remove();
        });
        $scope.$on('$destroy', function () {
            productService.unsub('logger');
        });
    });





});
//countCtrl2 controller //
//			WEBLOGS.controller('countCtrl2', function($scope,$http,$q){
//						angular.element(document).ready(function () {
//						$scope.res= [];
//						var httpRequest = $http({
//						method: 'GET',
//						url: 'http://cors.io/?u= http://www.mtl.uk.net/pls/logsheets/wwv_json_data.category_chart?p_customer_id=ACP&p_random=0.6006743305186666"',
//						}).success(function(json2, status) {
//						$scope.res=json2.data;
//						Morris.Bar({
//						element: 'chart_category',
//						data: json2.data,// use returned data to plot the graph,
//						xkey: 'category',
//						ykeys: ['value'],
//						labels: ['Logs'],
//						hideHover: 'auto',
//						resize: true
//						//
//						});
//						});
//						});
//			});
//countCtrl3 controller //
//			WEBLOGS.controller('countCtrl3', function($scope,$http,$q){
//					angular.element(document).ready(function () {
//					$scope.res= [];
//					var httpRequest = $http({
//					method: 'GET',
//					url: 'http://cors.io/?u=http://www.mtl.uk.net/pls/logsheets/wwv_json_data.priority_chart?p_customer_id=ACP&p_random=0.9410924760088444"',
//					}).success(function(json3, status) {
//					$scope.res=json3.data;
//					Morris.Bar({
//					element: 'chart_priority',
//					data: json3.data,// use returned data to plot the graph,
//					xkey: 'priority',
//					ykeys: ['value'],
//					labels: ['Logs'],
//					hideHover: 'auto',
//					//
//					});
//					});
//					});
//			});
//EntryCtrl controller//
WEBLOGS.controller('EntryCtrl', function ($scope, $http, $sce) {
    $scope.response = [];
    var obj = {};
    obj.getResponse = function () {
        var temp = {};
        var defer = $q.defer();
        $http.get(root_url + 'users/manage-users').success(function (data) {
            $scope.response = $sce.trustAsHtml(data);
            temp = data;
            defer.resolve(data);
        });
        return defer.promise;
    }
})

//end of script//

ESERV.controller('EservModalCtrl', ['$scope', '$modal', '$log', 'WEBLOGSServices', '$sce', function ($scope, $modal, $log, WEBLOGSServices, $sce) {

        $scope.openEservModal = function (id, header, size, Options) {

            if (typeof Options.close_open_modals != 'undefined') {
                switch (Options.close_open_modals) {
                    case 'all':
                        $scope.$dismiss();
                        break;
                    default:
                        var modals_to_close = Options.close_open_modals.split(',');
                        break;
                }
            }

            var modalInstance = $modal.open({
                templateUrl: 'eservModalContent.html',
                controller: ['$scope', '$modalInstance', '$sce', function ($scope, $modalInstance, $sce) {
                        $scope.modalId = id;
                        $scope.modalHeader = '';
                        $scope.modalBody = 'Loading...';
                        $scope.EservShowModalFooter = false;

                        $scope.modalHeader = header;

                        $scope.ok = function () {
                            $modalInstance.dismiss('cancel');
                        };

                        $scope.cancel = function () {
                            $modalInstance.dismiss('cancel');
                        };

                        WEBLOGSServices.getModalContent(Options.target_url).then(function (response) {
                            if (AJCompile && $scope) {
                                var html_content = AJCompile(response.data + '<div class="clearfix"></div>')($scope);
                                $('#' + $scope.modalId + ' .modal-body').html((typeof html_content != 'undefined' ? html_content : ''));
                            } else {
                                $('#' + $scope.modalId + ' .modal-body').html(response.data + '<div class="clearfix"></div>');
                            }
                            $scope.cancel = function () {
                                $modalInstance.dismiss('cancel');
                            };

                        });
                    }],
                size: size,
                backdrop: 'static',
                keyboard: (typeof (Options.keyboard) != 'undefined') ? Options.keyboard : true
            });
            modalInstance.result.then(function (res) {

            }, function () {
                //$log.info('Modal dismissed at: ' + new Date());
            });
        };
    }]);


angular.module('MTLESERV', ['MTLESERV.WEBLOGS']);

ESERV.controller('MainController', ['$scope', '$rootScope', '$http', '$location', 'ESERVServices', '$modal', '$log', '$interval', 'dialogs', 'Fullscreen', function ($scope, $rootScope, $http, $location, ESERVServices, $modal, $log, $interval, dialogs, Fullscreen) {

        $rootScope.dataTablePrint = function (elm) {
//            console.log(elm);

        };

        updateNotifications($rootScope, ESERVServices);

        setInterval(function () {
            updateNotifications($rootScope, ESERVServices);
        }, 30000);

        toggleScreenWidth($('#merlin_screen_width').val());

        $scope.goFullscreen = function () {
            if (Fullscreen.isEnabled()) {
                toggleScreenWidth('normal');
                Fullscreen.cancel();
            } else {
                toggleScreenWidth('wide');
                Fullscreen.all();
            }
        };

        $scope.isFullScreen = false;

        $scope.goFullScreenViaWatcher = function () {
            $scope.isFullScreen = !$scope.isFullScreen;
        };

        $scope.resetSettings = function (url) {
            var dlg = dialogs.confirm(
                    'Warning',
                    'This will reset all your saved settings to default. Are you sure you want to reset? \n\
                                                  <br/> Upon success you will be redirected to the home page.'
                    ,
                    {
                        size: 'md',
                        keyboard: false,
                        backdrop: 'static'
                    });
            dlg.result.then(function (btn) {
                $('body').removeClass('settings_expanded');
                toggleMainLoader('Processing..', true);
                resizeFont(default_app_font_size);
                toggleScreenWidth('normal');
                Fullscreen.cancel();
                if (ThemerProvider != null) {
                    ThemerProvider.setSelected(app_styles[0].key);
                }
                localStorage.clear();
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        ajax_main_loader: true
                    },
                    success: function (data) {
                        window.location = '#/dashboard';
                        toggleMainLoader('Processing..', false);
                        DisplayAppAlert('success', 'Your settings have been reset to default.');

                    },
                    error: function (err) {
                        toggleMainLoader('Processing..', false);
                        DisplayAppAlert('danger', err.statusText);
                    }
                    ,
                    statusCode: {
                        500: function (error) {
                            toggleMainLoader('Processing..', false);
                            DisplayAppAlert('danger', 'An internal server error has occurred');
                        }
                    }
                });
            });
        };

        $rootScope.openLoginForm = function (size) {

            var modalInstance = $modal.open({
                templateUrl: 'loginFormContent.html',
                controller: LoginCtrl,
                size: size,
                backdrop: 'static'
            });
            modalInstance.result.then(function () {

            }, function () {
                //$log.info('Modal dismissed at: ' + new Date());
            });
        };
        var LoginCtrl = ['$scope', '$modalInstance', '$http', function ($scope, $modalInstance, $http) {

                $scope.is_logging_in = false;
                $rootScope.loginError = false;
                 Auth.setUser('customer');
                $scope.ok = function (user_login_data) {
                    $scope.is_logging_in = true;
                    $rootScope.loginError = false;
                    if (typeof user_login_data != 'undefined' && user_login_data.username != null && user_login_data.password != null) {
                        $http({
                            url: root_url + 'doLogin',
                            method: "POST",
                            data: $.param({_username: user_login_data.username, _password: user_login_data.password}),
                            headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                        }).success(function (data, status, headers, config) {
                            $scope.is_logging_in = false;
                            if (data.status) {
                                $rootScope.is_loggedin = true;
                                AvailableTopics.get().then(function (data) {
                                    $rootScope.topicsList = data.tree;
                                    $scope.selected_search_topics = [];
                                    $scope.selected_topic = 'All Topics';
                                    $scope.selected_search_topics[0] = $rootScope.topicsList[0].id;
                                    
                                });
                                var _subscriptions = ESERVServices.getUserSubscription();
                                if (_subscriptions !== null) {
                                    _subscriptions.then(function (data) {
                                        if (typeof data.topics != 'undefined' && data.topics.subscribed_topic_list != null) {
                                            $rootScope.subscribed_topics = data.topics.subscribed_topic_list.split('/');
                                        }
                                        if (typeof data.topics != 'undefined' && data.topics.available_topic_list != null) {
                                            $rootScope.available_topics = data.topics.available_topic_list.split('/');
                                        }
                                    });
                                }
                                $modalInstance.dismiss('cancel');
                            } else {
                                $rootScope.loginError = true;
                                $rootScope.loginErrorMsg = data.msg;
                                //alert('Error: ' + data.msg);
                            }
                        }).error(function (data, status, headers, config) {
                            $scope.is_logging_in = false;
                            $rootScope.loginError = true;
                            $rootScope.loginErrorMsg = 'An error has occurred! Please try again';
                        });
                    } else {
                        $scope.is_logging_in = false;
                        $rootScope.loginError = true;
                        $rootScope.loginErrorMsg = 'An error has occurred! Please try again';
                    }
                };
                $scope.cancel = function () {
                    $scope.is_logging_in = false;
                    $rootScope.loginError = false;
                    $rootScope.loginErrorMsg = '';
                    $modalInstance.dismiss('cancel');
                };
            }];
        $rootScope.Logout = function (size) {

            var modalInstance = $modal.open({
                templateUrl: 'logoutContent.html',
                controller: LogoutCtrl,
                size: size,
                backdrop: 'static'
            });
            modalInstance.result.then(function () {

            }, function () {
                //$log.info('Modal dismissed at: ' + new Date());
            });
        };
        var LogoutCtrl = ['$scope', '$modalInstance', '$http', function ($scope, $modalInstance, $http) {

                $scope.is_logging_out = false;
                $scope.ok = function () {
                    toggleMainLoader('Logging out..', true);
                    $scope.is_logging_out = true;
                    $http({
                        url: logout_url,
                        method: "POST",
                        headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                    }).success(function (data, status, headers, config) {

                        if (data.status) {
                            $rootScope.is_loggedin = false;
                            $rootScope.showLoader = true;

                            HandleNotAuthenticated(false, false, notAuthenticatedCallback);

                        } else {
                            $scope.is_logging_out = false;
                            alert('Error: ' + data.msg);
                        }
                    }).error(function (data, status, headers, config) {
                        $scope.is_logging_out = false;
                    });
                };
                $scope.cancel = function () {
                    $scope.is_logging_out = false;
                    $modalInstance.dismiss('cancel');
                };
            }];

        $rootScope.formHasChanged = function (form_name) {
            var form = $('form[name="' + form_name + '"]');
            if (form.serialize() != form.data('serialize')) {
                $rootScope.FormChanged = true;
                return(true);
            }
            return(false);
        };
    }]);

WEBLOGS.controller('AboutCtrl', function ($scope, $modal, $log) {

    $scope.openAbout = function (size, commsOpts) {

        var modalInstance = $modal.open({
            templateUrl: 'about.html',
            controller: ModalInstanceCtrl,
            size: size
        });

        modalInstance.result.then(function () {

        }, function () {
            //$log.info('Modal dismissed at: ' + new Date());
        });
    };

    var ModalInstanceCtrl = function ($scope, $modalInstance) {

        $scope.ok = function () {

        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
    };
});
/* top filter selection code */
//if ($("#last_customer_select").val() != '')
//{
//
//    $('select option[value=' + $("#last_customer_select").val() + ']').prop("selected", true);
//}

