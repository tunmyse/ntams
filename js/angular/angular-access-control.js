var accessModule = angular.module('tams-app', []);
    
accessModule.controller('PageController', function($scope) {
    $scope.data = {
        "edit": false
    };
      
    $scope.enableEdit = function () {
        $scope.data.edit = !$scope.data.edit;
    };
});

accessModule.directive('bootAhead', function($http) {
    
    return {
        restrict: 'EA',
        replace: true,
        template: '<div>\n\
                        <input type="text" class="input-xlarge" placeholder="{{holderText}}"/>\n\
                        <table class="table table-striped margin">\n\
                            <thead><th>{{searchType}}(s) to add</th></thead>\n\
                            <tr ng-repeat="item in items">\n\
                                <td>\n\
                                    <span>{{item.name}}</span>\n\
                                    <span class="pull-right" ng-click="remove($index)" style="cursor: pointer">\n\
                                        x\n\
                                    </span>\n\
                                    <input type="hidden" name="items[]" value="{{item.id}}"/>\n\
                                </td>\n\
                            </tr>\n\
                        </table>\n\
                    </div>',
        scope: {
            "holderText": "@",
            "searchType": "@",
            "actionUrl": "@url"
            
        },
        link: function(scope, elem, attrs) {
            scope.items = [];
            
            scope.remove = function(index) {
                scope.items.splice(index, 1);
            };
            
            var typeInput = elem.find('input');
            typeInput.typeahead({
                source: function(query, process) {
                    $http.post(
                        scope.actionUrl, 
                        '', 
                        { 
                            params: {
                                query: query,
                                type: scope.searchType,
                                exclude: (_.chain(scope.items).pluck('id').uniq().value()).join("_")
                            }
                        }
                    ).success(function(data, status, headers) {
                        var suggestions = _.map(data, function(item) {
                            return JSON.stringify(item);
                        });
                        return process(suggestions);
                    });                       
                    
                },

                highlighter: function (obj) {
                    var item = JSON.parse(obj);
                    var query = this.query.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, '\\$&')
                    return item.name.replace(new RegExp('(' + query + ')', 'ig'), function ($1, match) {
                        return '<strong>' + match + '</strong>'
                    });
                },

                sorter: function (items) {          
                    var beginswith = [], caseSensitive = [], caseInsensitive = [], item;
                    while (aItem = items.shift()) {
                        var item = JSON.parse(aItem);
                        if (!item.name.toLowerCase().indexOf(this.query.toLowerCase())) 
                            beginswith.push(JSON.stringify(item));
                        else if (~item.name.indexOf(this.query)) 
                            caseSensitive.push(JSON.stringify(item));
                        else 
                            caseInsensitive.push(JSON.stringify(item));
                    }

                    return beginswith.concat(caseSensitive, caseInsensitive)

                 },

                updater: function (obj) {
                    scope.$apply(scope.items.unshift(JSON.parse(obj)));
                    return '';
                }
            });
            
        }
    };
       
});

accessModule.directive('userFilter', function($http, $timeout) {
    
    return {
        restrict: 'EA',
        replace: true,
        template: '<div>\n\
                        <div ng-show="enabled">\n\
                            <div>\n\
                                <select id="usertype" class="chosen-select input-medium" ng-model="data.usertype">\n\
                                    <option value="prospective">Prospective</option>\n\
                                    <option value="student">Student</option>\n\
                                    <option value="staff">Staff</option>\n\
                                    <option value="admin">Admin</option>\n\
                                </select>\n\
                                <input type="text" class="input-small btn" ng-click="clearFilter()" value="Clear All Filter"/>\n\
                            </div>\n\
                            <div id="filter-id" ng-repeat="filter in filters">\n\
                                <select class="chosen-select input-small" id="group{{$index}}" ng-if="!$first" ng-model="filter.group">\n\
                                    <option value="or">OR</option>\n\
                                    <option value="and">AND</option>\n\
                                </select>\n\
                                <select class="chosen-select input-medium" id="attr{{$index}}" ng-model="filter.attr">\n\
                                    <option value="or">Matric</option>\n\
                                    <option value="or">Last Name</option>\n\
                                    <option value="or">First Name</option>\n\
                                    <option>Level</option>\n\
                                    <option>Gender</option>\n\
                                    <option>Religion</option>\n\
                                    <option>State of Origin</option>\n\
                                    <option>Programme</option>\n\
                                    <option>Department</option>\n\
                                    <option>College</option>\n\
                                </select>\n\
                                <select class="chosen-select input-medium" id="func{{$index}}" ng-model="filter.func">\n\
                                    <option>contains</option>\n\
                                    <option>equals</option>\n\
                                    <option>greater than</option>\n\
                                    <option>less than</option>\n\
                                    <option>in</option>\n\
                                </select>\n\
                                <input type="text" class="input-small" ng-model="filter.val"/>\n\
                                <a ng-click="removeFilter($index)"><i class="icon-trash"></i></a>\n\
                                <a ng-show="$last" ng-click="addFilter()"><i class="icon-plus-sign"></i></a>\n\
                            </div>\n\
                            <button type="button" ng-hide="enabled" class="btn" ng-click="getFilter()" >\n\
                                Filter\n\
                            </button>\n\
                        </div>\n\
                        <button type="button" ng-hide="enabled" class="btn" ng-click="createFilter()" >\n\
                            <i class="icon-filter"></i>Filter\n\
                        </button>\n\
                    </div>',
        scope: {
        },
        link: function(scope, elem, attrs) {
            scope.enabled = false;
            scope.data = {
                usertype: "prospective"                
            };
            
            scope.$watch("data.usertype", function(value) {
                console.log("watch");
                if(scope.data.usertype !== value) {
                    scope.clearFilter();
                    scope.createFilter();
                }
            });
            
            scope.filters = [];
            
            scope.createFilter = function() {
                scope.enabled = true;
                scope.filters.push({"group": "OR", "attr": "", "func": "contains", "val": ""});
                scope.updateDropdown();
            };
            
            scope.clearFilter = function() {
                scope.enabled = false;
                scope.filters = [];
                scope.data.usertype = "prospective" ;
                scope.updateDropdown();
            };
            
            scope.getFilter = function() {
                $http.post("", {
                    
                });
            };
            
            scope.addFilter = function() {
                var filter = scope.filters[scope.filters.length - 1];
                
                if(!filter.val || !filter.attr) {
                    alert("Supply all the information for the last filter before creating another!");
                    return;
                }
                scope.filters.push({"group": "or", "attr": "", "func": "contains", "val": ""});
                scope.updateDropdown();
            };
            
            scope.removeFilter = function(index) {
                scope.filters.splice(index, 1);
            };
            
            scope.updateDropdown = function() {
                $timeout(function() {
                    elem.find('#filter-id .chosen-select').chosen({});
                    elem.find('.chosen-select').trigger('liszt:updated');                         
                }, 0);           
            };          
        }
    };
       
});