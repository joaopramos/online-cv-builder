(function(){
  'use strict';

    var ElementController = [ '$scope', 'cvFactory', '$q',
        function ($scope, cvFactory, $q) {
            this.init = $q.defer();
            $scope.init = this.init;

            if($scope.id) {
                var el=cvFactory.create('cv',$scope.id, null);
                $scope.cv = {element : el};
                this.init.resolve(el.loadingPromise());
            }
            else if($scope.element) {
                this.init.resolve(element.loadingPromise());
            }
    }];

    var linkChildByName = function(type) {
        return function(scope, element, attrs, controller) {
            controller.init.promise.then( function (parent) {
                if(type)
                    parent.findChild(type,'name', attrs.name).then(function (found) {
                        scope.element = found;
                        if(scope.init) scope.init.resolve(found.loadingPromise());
                    });
            });
        };
    };
    var linkElement = function() {
        return function(scope, element, attrs, controller) {
           controller.init.promise.then(function(el) {
                scope.element = el;
           });
        };
    };

    angular.module('cv').directive('cvOnline',
        function() {
            return {
                restrict: 'E',
                transclude: true,
                controller: ElementController,
                scope: { id: '@' },
                template:'<div ng-transclude></div>',
            };
        }
    );
    angular.module('cv').directive('cvPicture',
        function() {
            return {
                restrict: 'E',
                require: '^cvOnline',
                link: linkElement(),
                scope: true,
                template:'<img ng-src="{{element.data.profilepic}}" width="100%">',
            };
        }
    );
    angular.module('cv').directive('cvHeader',
        function() {
            return {
                restrict: 'E',
                require: '^cvOnline',
                transclude: true,
                scope: { name: '@' },
                link: linkChildByName('cvHeader'),
                template:'{{ element.data.value }}',
            };
        }
    );
    angular.module('cv').directive('cvSection',
        function() {
            return {
                restrict: 'E',
                require: '^cvOnline',
                transclude: true,
                controller: ElementController,
                scope: { name: '@' },
                link: linkChildByName('section'),
                template:'<div ng-transclude></div>',
            };
        }
    );
    angular.module('cv').directive('cvSectionName',
        function() {
            return {
                restrict: 'E',
                require: '^cvSection',
                link: linkElement(),
                scope: true,
                template:'{{element.data.name}} ',
            };
        }
    );
    angular.module('cv').directive('cvItems',
        function() {
            return {
                restrict: 'E',
                require: '^cvSection',
                transclude: true,
                link: linkElement(),
                template:
                '<div ng-repeat="item in element.childs[\'item\']" inject/>',

            };
        }
    );
    angular.module('cv').directive('cvItemName',
        function() {
            return {
                restrict: 'E',
                require: '^cvItems',
                template:'{{item.data.name}}',
            };
        }
    );
    angular.module('cv').directive('cvItemHeader',
        function() {
            return {
                restrict: 'E',
                require: '^cvItems',
                scope: { name: '@' },
                controller: ['$scope', function($scope) {
                    $scope.$parent.item.loadingPromise().then(function(item) {
                        item.findChild('itemHeader','name', $scope.name).then(function (found) {
                            $scope.header = found.data.value;
                        });
                    });
                }],
                template:'{{header}}',
            };
        }
    );
    angular.module('cv').directive('cvEntries',
        function() {
            return {
                restrict: 'E',
                require: '^cvItems',
                transclude: true,
                template:
                '<div ng-repeat="entry in item.childs[\'entry\']" inject/>',
            };
        }
    );
    angular.module('cv').directive('cvEntry',
        function() {
            return {
                restrict: 'E',
                require: '^cvEntries',
                template:'{{entry.data.entry}}',
            };
        }
    );
    angular.module('cv').directive('cvEntryPhotos',
        function() {
            return {
                restrict: 'E',
                require: '^cvEntries',
                template:
                    '<carousel interval="10000">'
                    +'<slide ng-repeat="slide in entry.childs[\'image\']"><img ng-src="{{slide.data.image}}" style="margin:auto;width:100%"/>'
                    +'<div style="background-color:rgba(0,0,0,.6)" class="carousel-caption">{{slide.data.description}}</div>'
                    +'</slide> </carousel>',
            };
        }
    );
    angular.module('cv').directive('inject', function() {
      return {
        link: function($scope, $element, $attrs, controller, $transclude) {
          if (!$transclude) {
                return;
          }
          var innerScope = $scope.$new();
          $transclude(innerScope, function(clone) {
            $element.empty();
            $element.append(clone);
            $element.on('$destroy', function() {
              innerScope.$destroy();
            });
          });
        }
      };
    });
    angular.module('cv').directive('disableAnimation', ['$animate', function($animate){
        return {
            restrict: 'A',
            link: function($scope, $element, $attrs){
                $attrs.$observe('disableAnimation', function(value){
                    $animate.enabled(!value, $element);
                });
            }
        }
    }]);
})();

