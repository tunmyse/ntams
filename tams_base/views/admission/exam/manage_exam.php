<div>                   
    <div class="box">                
        <div class="box-title">
            <ul class="tabs">
                <li class="btn btn-green" data-toggle="modal" href="#create_group_modal">                             
                     <i class="icon-plus"> </i>
                        New Exam Group                       
                </li>
                 <li class="btn btn-green" data-toggle="modal" href="#create_exam_modal">
                     <i class="icon-plus"> </i>
                        New Exam
                 </li>
                <li class="btn btn-green" data-toggle="modal" href="#create_subject_modal">                             
                     <i class="icon-plus"> </i>
                        New Subject                        
                </li>
                 <li class="btn btn-green" data-toggle="modal" href="#create_grade_modal">
                     <i class="icon-plus"> </i>
                        New Grade
                 </li>

            </ul> 
        </div>
    </div>
    
    
    <div class="box box-color box-bordered">                
        <div class="box-title">
            <h3>
                <i class="icon-edit"></i>
                Exam Management
            </h3>
            <ul class="tabs">
                <li class="active"><a href="#group" data-toggle="tab">Exam Group</a></li>
                <li><a href="#exam" data-toggle="tab">Exam</a></li>
                <li><a href="#subject" data-toggle="tab">Subjects</a></li>
                <li><a href="#grade" data-toggle="tab">Grades</a></li>                            
            </ul>  
        </div>
        <div class="box-content nopadding">
            <div class="tab-content ">       
                
                <div id="group" class="tab-pane active">
                    <table class="table table-hover table-nomargin">
                        <thead>
                            <tr>
                                <th>S/N</th>                                
                                <th>Name</th>
                                <th>Required</th>                                
                                <th>Max Entries</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="group in data.groups">
                                <td ng-bind="$index+1"></td>
                                <td ng-bind="group.groupname"></td>
                                <td ng-bind="group.required"></td>
                                <td ng-bind="group.maxentries"></td> 
                                <td ng-bind="group.status"></td>  
                                <td>
                                    <div class="btn-group">
                                        <a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
                                            <i class="icon-cog"> </i>
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-success">
                                            <li>
                                                <a ng-click="openEditDialog('group', $index, $event)">Edit</a>
                                            </li>
                                            <li>
                                                <a ng-click="openDeleteDialog('group', $index, $event)">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr ng-show="data.groups.length < 1">                                
                                <td colspan="6">
                                    <?php echo sprintf($this->lang->line('no_entries'), 'groups')?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div id="exam" class="tab-pane">
                    <table class="table table-hover table-nomargin">
                        <thead>
                            <tr>
                                <th>S/N</th>                                
                                <th>Name</th>
                                <th>Shortname</th>                               
                                <th>Valid Exam Years</th>
                                <th>Minimum Subjects</th>                                
                                <th>Score-Based</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="exam in data.exams">
                                <td ng-bind="$index+1"></td>
                                <td ng-bind="exam.examname"></td>
                                <td ng-bind="exam.shortname"></td>
                                <td ng-bind="exam.validyears"></td>
                                <td ng-bind="exam.minsubject"></td>
                                <td ng-bind="exam.scorebased"></td> 
                                <td ng-bind="exam.status"></td>  
                                <td>
                                    <div class="btn-group">
                                        <a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
                                            <i class="icon-cog"> </i>
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-success">
                                            <li>
                                                <a ng-click="openEditDialog('exam', $index, $event)">Edit</a>
                                            </li>
                                            <li>
                                                <a ng-click="openDeleteDialog('exam', $index, $event)">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr ng-show="data.exams.length < 1">                                
                                <td colspan="8">
                                    <?php echo sprintf($this->lang->line('no_entries'), 'exams')?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div id="subject" class="tab-pane">
                    <table class="table table-hover table-nomargin">
                        <thead>
                            <tr>
                                <th>S/N</th>                                
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="subj in data.subjects">
                                <td ng-bind="$index+1"></td>
                                <td ng-bind="subj.subname"></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
                                            <i class="icon-cog"> </i>
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-success">
                                            <li>
                                                <a ng-click="openEditDialog('subject', $index, $event)">Edit</a>
                                            </li>
                                            <li>
                                                <a ng-click="openDeleteDialog('subject', $index, $event)">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr ng-show="data.subjects.length < 1">                                
                                <td colspan="3">
                                    <?php echo sprintf($this->lang->line('no_entries'), 'subjects')?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div id="grade" class="tab-pane">
                    <table class="table table-hover table-nomargin">
                        <thead>
                            <tr>
                                <th>S/N</th>                                
                                <th>Name</th>
                                <th>Weight</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="grade in data.grades">
                                <td ng-bind="$index+1"></td>
                                <td ng-bind="grade.gradename"></td> 
                                <td ng-bind="grade.gradeweight"></td> 
                                <td ng-bind="grade.gradedesc"></td> 
                                <td>
                                    <div class="btn-group">
                                        <a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
                                            <i class="icon-cog"> </i>
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-success">
                                            <li>
                                                <a ng-click="openEditDialog('grade', $index, $event)">Edit</a>
                                            </li>
                                            <li>
                                                <a ng-click="openDeleteDialog('grade', $index, $event)">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr ng-show="data.grades.length < 1">                                
                                <td colspan="5">
                                    <?php echo sprintf($this->lang->line('no_entries'), 'grades')?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</div>
<script>

    var groups = <?php echo (is_array($groups))? json_encode($groups): '[]'?>;

    var exams = <?php echo (is_array($exams))? json_encode($exams): '[]'?>;
    
    var grades = <?php echo (is_array($grades))? json_encode($grades): '[]'?>;
    
    var subjects = <?php echo (is_array($subjects))? json_encode($subjects): '[]'?>;
</script>
