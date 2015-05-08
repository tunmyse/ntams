var setupModule = angular.module('tams-app', []);
    
setupModule.controller('PageController', function($scope) {
    
    $scope.data = {
        "colleges": colleges,
        "depts": depts,
        "progs": progs
    };

    colleges = null;    
    depts = null;
    progs = null;

    $scope.current = {};
    
    angular.element('.modal').on('shown', function() {
        angular.element(this).find('.chosen-select').trigger('liszt:updated');
        
        angular.element(this).find('.spinner').spinner('option', {
                min: 1,
                max: 10
        }).spinner("value", $scope.current['duration']);
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
         
        switch(name) {
            case 'college': 
                $scope.current['name'] = $scope.current['colname'];
                $scope.current['id'] = $scope.current['colid'];
                break;
                
            case 'dept': 
                $scope.current['name'] = $scope.current['deptname'];
                $scope.current['id'] = $scope.current['deptid'];
                break;
            
            case 'prog': 
                $scope.current['name'] = $scope.current['progname'];
                $scope.current['id'] = $scope.current['progid'];
                break;
        }
        
        angular.element(href).modal('show'); 
        e.preventDefault();
    };
    
});
