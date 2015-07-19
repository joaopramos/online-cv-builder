(function(){
  'use strict';
    angular.module('cv').directive('cvElement',
        ['$baseUrl', function($baseUrl) {
            return {
                restrict: 'E',
                controller: 'ElementController',
                controllerAs: 'element',
                scope: {
                    element: '=',
                    init: '@',
                },
                templateUrl: $baseUrl+'dist/templates/cv/edit/cvElement.html',
            };
        }]);
})();
