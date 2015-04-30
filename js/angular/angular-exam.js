var examModule = angular.module('tams-app', []);
    
examModule.controller('PageController', function($scope) {
    
    $scope.data = {
        "groups": groups,
        "exams": exams,
        "grades": grades,
        "subjects": subjects
    };

    groups = null;
    exams = null;
    grades = null;
    subjects = null;    

    $scope.current = {};
    
    angular.element('.modal').on('shown', function() {
        angular.element(this).find('.chosen-select').trigger('liszt:updated');
    });
    
    $scope.openEditDialog = function(name, idx, e) {         
        var href = '#edit_'+name+'_modal';         
        $scope.openDialog(href, name, idx, e);
    }; 

    $scope.openDeleteDialog = function(name, idx, e) {         
        var href = '#delete_modal'; 
        $scope.openDialog(href, name, idx, e);
    }; 
    
    $scope.openDialog = function(href, name, idx, e) {
        angular.copy($scope.data[name+'s'][idx], $scope.current);
        
        if($scope.current === null)
            return;
               
        angular.element(href).modal('show');         
        e.preventDefault();
    };
    
});
