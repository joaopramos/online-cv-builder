(function(){
    'use strict';
    angular.module('cv').controller('EditController',
    ['$scope', '$anchorScroll', '$cvId',
    function($scope, $anchorScroll, $cvId) {

        $scope.cvId = $cvId;

        $scope.sideMenu = {
            show: false,
            menu: 'structure'
        };

        $scope.openMenu = function(menu) {
            $scope.sideMenu.menu = menu;
            $scope.sideMenu.show = true;
            $anchorScroll('top');
        };
    }]);
}());

