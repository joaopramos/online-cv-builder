(function(){
    'use strict';
    angular.module('cv')
    .factory('cvStructure', [ function() {
        return {
            cv: {
                title: 'CV',
                editable: { 'profilepic':'image'},
                ordered: false,
                api: 'api/cv',
                inherit: {},
                childs: {'cvHeader':'Cv Headers',
                    'section':'Sections'},
                init: {},
                addableChilds: false,
                removable : false,
                collapsed : false,
            },
            cvHeader: {
                title: 'CV Header',
                editable: {'name':'readOnly', 'value':'string'},
                ordered: false,
                api: 'api/cvheader',
                inherit: {'cv_id':'id'},
                childs: null,
                init: {'value': 'cv header value'},
                removable : false,
            },
            section: {
                title: 'Section',
                editable: {'name':'readOnly'},
                ordered: true,
                api: 'api/section',
                inherit: {'cv_id':'id'},
                childs: {'item':'Items'},
                init: {'name':'section title'},
                addableChilds : true,
                removable : false,
                collapsed : true,
            },
            item: {
                title: 'Item',
                editable: {'name':'string'},
                ordered: true,
                api: 'api/item',
                inherit: {'section_id':'id'},
                childs: {'itemHeader':'Item Headers', 'entry':'Entries'},
                init: {'name':'item title'},
                addableChilds : true,
                removable : true,
                collapsed : true,
            },
            itemHeader: {
                title: 'Item Header',
                editable: {'name':'string', 'value': 'string'},
                ordered: true,
                api: 'api/itemheader',
                inherit: {'item_id':'id'},
                childs: null,
                init: {'name':'header name', 'value':'header value'},
                removable : true,
            },
            entry: {
                title: 'Entry',
                editable: {'entry':'textarea'},
                ordered: true,
                api: 'api/entry',
                inherit: {'item_id':'id'},
                childs: {'image': 'Images'},
                init: {'entry':'text'},
                addableChilds : true,
                removable : true,
                collapsed : false,
            },
            image: {
                title: 'Image',
                editable: {'description':'string', 'image':'image' },
                ordered: true,
                api: 'api/image',
                inherit: {'entry_id':'id'},
                childs: null,
                init: {'description':'description'},
                removable : true,
            }
        };
    }]);
}());


