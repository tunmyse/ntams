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
        $('.chosen-select').trigger('liszt:updated');
    });
    
    $scope.openEditDialog = function(name, idx, e) {         
        var href = '#edit_'+name+'_modal';        
        $scope.current = null;
        $scope.current = $scope.data[name+'s'][idx]; 
        
        if($scope.current != null)
            angular.element(href).modal('show');
        
        e.preventDefault();
    }; 

    $scope.openDeleteDialog = function(name, idx, e) {         
        var href = '#delete_modal'; 
        $scope.current = null;
        $scope.current = $scope.data[name+'s'][idx]; 
        
        if($scope.current != null)
            angular.element(href).modal('show');
        
        e.preventDefault();
    }; 
    
});