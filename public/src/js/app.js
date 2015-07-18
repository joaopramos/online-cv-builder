(function() {
    'use strict';
    angular.module('cv', ['ui.router', 'ui.bootstrap', 'ngAnimate', 'ngToast',
        'utils', 'naif.base64'])

    .run(['$rootScope', '$window', '$currentUser', '$baseUrl', '$cvId', '$state', 'ngToast',
    function($rootScope, $window, $currentUser, $baseUrl, $cvId, $state, ngToast ) {
        if($window.location.href === $baseUrl) {
            if( $currentUser ) $state.go('edit', {}, { location:false });
            else $state.go('home', {}, { location:false });
        }
        else if($cvId)
            $state.go('view', {}, { location:false });

        $rootScope.$on('notifyUser', function(e, notification) {
            ngToast.create({
                content: notification,
                timeout: 2000,
            });
        });
    }])

    .config(['$stateProvider', '$urlRouterProvider', '$animateProvider',
    function($stateProvider, $urlRouterProvider, $animateProvider) {
        $stateProvider
        .state('home', {
            url: '/home',
            templateUrl: '/dist/templates/welcome.html',
            controller: 'AppCtrl',
        })
        .state('edit', {
            url: '/edit',
            templateUrl: 'dist/templates/cv/edit/edit.html',
            controller: 'EditController'
        })
        .state('view', {
            url: '/view',
            templateUrl: 'dist/templates/cv/view.html',
            controller: ['$scope', '$cvId', function($scope, $cvId) {
                $scope.cvId = $cvId;
            }]
        });

      //$urlRouterProvider.otherwise('/');
    }])


    .controller('AppCtrl', ['$scope', function($scope) {
        var ctrl = this;
        $scope.welcome = 'CV online for coders';
    }]);
}());
