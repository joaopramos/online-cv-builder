(function(){
    'use strict';
    angular.module('cv').controller('EditController',
    ['$scope', '$anchorScroll', '$cvId', '$http',
    function($scope, $anchorScroll, $cvId, $http) {

        $scope.cvId = $cvId;
        $scope.sideMenu = {
            show: false,
            menu: ''
        };
        $scope.templates=[];
        loadTemplates();

        $scope.openMenu = function(menu) {
            if($scope.sideMenu.menu === menu) {
                $scope.sideMenu.show = false;
                $scope.sideMenu.menu = '';
            }
            else {
                $scope.sideMenu.menu = menu;
                $scope.sideMenu.show = true;
                $anchorScroll('top');
            }
        };

        function loadTemplates() {
            $http.get('templates').then(function(response){
                $scope.templates = response.data;
            })
        }
    }]);
}());

