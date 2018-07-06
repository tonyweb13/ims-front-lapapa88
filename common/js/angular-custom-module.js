'use strict';
angular.module("internationalPhoneNumber", ['ngCookies']).directive('internationalPhoneNumber', function($rootScope) {
    return {
        restrict: 'A',
        require: '^ngModel',
        scope: {
            ngModel: '=',
            defaultCountry: '@'
        },
        link: function(scope, element, attrs, ctrl) {
            var handleWhatsSupposedToBeAnArray, options, read, watchOnce;
            read = function() {
                return ctrl.$setViewValue(element.val());
            };
            handleWhatsSupposedToBeAnArray = function(value) {
                if (value instanceof Array) {
                    return value;
                } else {
                    return value.toString().replace(/[ ]/g, '').split(',');
                }
            };

            options = {
                onlyCountries:undefined,
                autoFormat: true,
                autoHideDialCode: true,
                responsiveDropdown: false,
                nationalMode: true,
                utilsScript: "/common/js/utill.js"
            };

            angular.forEach(options, function(value, key) {
                var option;
                if (!(attrs.hasOwnProperty(key) && angular.isDefined(attrs[key]))) {
                    return;
                }
                option = attrs[key];
                if (key === 'preferredCountries') {
                    return options.preferredCountries = handleWhatsSupposedToBeAnArray(option);
                } else if (key === 'onlyCountries') {
                    return options.onlyCountries = handleWhatsSupposedToBeAnArray(option);
                } else if (typeof value === "boolean") {
                    return options[key] = option === "true";
                } else {
                    return options[key] = option;
                }
            });
            watchOnce = scope.$watch('ngModel', function(newValue) {
                return scope.$$postDigest(function() {
                    options.defaultCountry = scope.defaultCountry;
                    if (newValue !== null && newValue !== void 0 && newValue !== '') {
                        element.val(newValue);
                    }
                    //console.log(options);
                    element.intlTelInput(options);
                    if (!(attrs.skipUtilScriptDownload !== void 0 || options.utilsScript)) {
                        element.intlTelInput('loadUtils', '/common/js/utill.js');
                    }
                    return watchOnce();
                });
            });
            ctrl.$formatters.push(function(value) {
                if (!value) {
                    return value;
                } else {
                    //$timeout(function() {
                    //    return element.intlTelInput('setNumber', value);
                    //}, 200);
                    //return element.val();
                }
            });
            ctrl.$parsers.push(function(value) {
                if (!value) {
                    return value;
                }
                //console.log(value);
                return value.replace(/[^\d]/g, '')
            });

            ctrl.$validators.internationalPhoneNumber = function(value) {
                if (!value) {
                    return value;
                } else {
                    return element.intlTelInput("isValidNumber");
                }
            };

            element.on('blur keyup change', function(event) {
                return scope.$apply(read);
            });
            return element.on('$destroy', function() {
                element.intlTelInput('destroy');
                return element.off('blur keyup change');
            });
        }
    };
});

angular.module('ngSweetAlert', [])
.factory('SweetAlert', ['$rootScope', function($rootScope) {
    var swal = window.swal;
    //public methods
    var self = {
        swal: function(arg1, arg2, arg3) {
            $rootScope.$evalAsync(function() {
                if (typeof(arg2) === 'function') {
                    swal(arg1, function(isConfirm) {
                        $rootScope.$evalAsync(function() {
                            arg2(isConfirm);
                        });
                    }, arg3);
                } else {
                    swal(arg1, arg2, arg3);
                }
            });
        },
        success: function(title, message) {
            $rootScope.$evalAsync(function() {
                swal(title, message, 'success');
            });
        },
        error: function(title, message) {
            $rootScope.$evalAsync(function() {
                swal(title, message, 'error');
            });
        },
        warning: function(title, message) {
            $rootScope.$evalAsync(function() {
                swal(title, message, 'warning');
            });
        },
        info: function(title, message) {
            $rootScope.$evalAsync(function() {
                swal(title, message, 'info');
            });
        }
    };
    return self;
}]);
