(function(){
    'use strict';
    angular.module('cv').controller('ElementController',
    ['$scope', 'cvFactory', '$timeout', function($scope, cvFactory, $timeout) {
        if($scope.init==='true') {
            $scope.element = $scope.$parent.$parent.cv.element;
        }

        $scope.onBlur = function (e) {
            if($scope.element.changed) {
                $scope.element.changed=false;
                $scope.element.update();
            }
        };

        $scope.destroy = function () {
            $scope.element.destroy();
        };
    }]);
}());

