(function() {
    'use strict';
    angular.module('welcomeApp', ['ui.router'])

    .run(function() {
    })

    .config(['$stateProvider', '$urlRouterProvider',
    function($stateProvider, $urlRouterProvider) {
        $stateProvider
        .state('home', {
            url: '/home',
            templateUrl: 'dist/templates/welcome.html',
            controller: 'AppCtrl',
        });

      $urlRouterProvider.otherwise('home');
    }])

    .controller('AppCtrl', ['$scope', function($scope) {
        var ctrl = this;
        $scope.welcome = 'Laravel + Angular Boilerplate';
    }]);
}());
