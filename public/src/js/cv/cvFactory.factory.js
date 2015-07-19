(function(){
    'use strict';
    angular.module('cv')
    .factory('cvFactory', ['$http', '$baseUrl', 'cvStructure', '$rootScope', '$timeout', '$q',
    function( $http, $baseUrl, cvStructure, $rootScope, $timeout, $q ) {

        var ElementFactory = {
            create: function (type, id, parent) {
                return new ElementConstructor(type,id, parent);
            },
            createLastChild: function (type, id, parent, data) {
                return new ElementConstructor(type, id, parent, data);
            }
        };
        return ElementFactory;

        function ElementConstructor(type, id, parent, data) {
            var el = this;
            this.structure = cvStructure[type];
            this.id = id;
            this.type = type;
            this.parent = parent;
            this.loading = false;
            this.collapsed = this.structure.collapsed;
            this.childs = {};
            this.defer = $q.defer();

            this.loadElement = function() {
                el.loading = true;
                $http.get($baseUrl+el.getApi()+'/'+el.id).then(function(response) {
                    el.loading = false;
                    el.defer.resolve(el);
                    el.data=response.data.data;
                    if(response.data.childs)
                        el.loadChilds(response.data.childs);
                });
                return el.defer.promise;
            };

            this.loadChilds = function(childs) {
                angular.forEach(childs, function (group, type) {
                    el.childs[type]=[];
                    angular.forEach(group, function (child) {
                        if (cvStructure[type].childs)
                            el.childs[type].push( ElementFactory.create(
                                type, child.id, el) );
                        else
                            el.childs[type].push( ElementFactory.createLastChild(
                                type, child.id, el, child) );
                    });
                });
            };

            this.update = function() {
                $http.put($baseUrl+el.getApi()+'/'+el.id, el.data).then(function() {
                    el.notifyUser(el.getTitle() + ' updated');
                });
            };

            this.updateImage = function (fieldname) {
                return function() {
                    $timeout( function() {
                        var file = el.imageToUpload;
                        el.data[fieldname]='data:'+file.filetype+';base64,'+file.base64;
                        $http.put($baseUrl+el.getApi()+'/'+el.id, el.data).then(function() {
                            el.notifyUser(el.getTitle() + ' updated');
                        });
                    },200);
                };
            }

            this.remove = function() {
                angular.forEach(parent.childs[el.type], function(value, key) {
                    if(value === el)
                        parent.childs[el.type].splice(key, 1);
                });
            };

            this.destroy = function() {
                $http.delete($baseUrl+el.getApi()+'/'+el.id, el.data).then(function() {
                    el.notifyUser(el.getTitle() + ' deleted');
                    el.remove();
                });
            };

            this.createChild = function(type) {
                var params = cvStructure[type].init;
                angular.forEach( cvStructure[type].inherit, function(value, key) {
                    params[key]=el.data[value];
                } );
                $http.post($baseUrl+cvStructure[type].api, params).then(function(response) {
                    el.notifyUser(el.getTitle() + ' created');
                    el.collapsed = false;
                    el.childs[type].push( ElementFactory.create( type,
                        response.data.data.id, el) );
                });
            };
            this.findChild = function (type, attr, value) {
                var defer = $q.defer();
                angular.forEach(el.childs[type], function(child) {
                    child.loadingPromise().then( function() {
                        if( child.data[attr] === value ) defer.resolve(child);
                    });
                });
                return defer.promise;
            };

            this.notifyUser = function (notification) {
                $rootScope.$emit('notifyUser', notification);
            };
            this.getApi = function () { return el.structure.api; };
            this.getEditable = function () { return el.structure.editable; };
            this.getTitle = function () { return el.structure.title; };
            this.isOrdered = function () { return el.structure.ordered; };
            this.getChilds = function () { return el.structure.childs; };
            this.canAdd = function () { return el.structure.addableChilds; };
            this.canRemove = function () { return el.structure.removable; };
            this.loadingPromise = function () { return el.defer.promise; };
            this.getValue = function () { return el.data[el.structure.value]; };

            if (typeof data === 'undefined') {
                this.loadElement();
            }
            else {
                this.data = data;
                this.defer.resolve();
            }
        }
    }]);
}());


