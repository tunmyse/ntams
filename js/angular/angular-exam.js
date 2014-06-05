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

    $scope.current = null;
    
    angular.element('.modal').on('show', function() {
        angular.element(this).find('.chosen-select').each(function() {
            return function(that) {
                setTimeout(function(){angular.element(that).trigger('liszt:updated');},100);   
            }(this);
        });
    });
    
    $scope.openEditDialog = function(name, idx, e) {         
        var href = '#edit_'+name+'_modal';         
        $scope.openDialog(href, name, idx, e);
    }; 

    $scope.openDeleteDialog = function(name, idx, e) {         
        var href = '#delete_modal'; 
        $scope.current = null;
        $scope.openDialog(href, name, idx, e);
    }; 
    
    $scope.openDialog = function(href, name, idx, e) {
        $scope.current = null;
        $scope.current = angular.copy($scope.data[name+'s'][idx]);
        
        if($scope.current === null)
            return;
               
        angular.element(href).modal('show'); 
        
        e.preventDefault();
    };
    
});
