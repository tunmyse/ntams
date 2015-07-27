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
