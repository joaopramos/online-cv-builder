(function(){
  'use strict';
    angular.module('cv').directive('cvElement',
        function() {
            return {
                restrict: 'E',
                controller: 'ElementController',
                controllerAs: 'element',
                scope: {
                    element: '=',
                    init: '@',
                },
                templateUrl:'dist/templates/cv/edit/cvElement.html',
            };
        }
    );
})();
