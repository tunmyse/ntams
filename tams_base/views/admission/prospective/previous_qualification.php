<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Prospective Registartion form 2 
 * 
 * @category   View
 * @package    Admission
 * @subpackage Prospective registaration
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

//var_dump($exam_grade['rs']);
?>
<div class="row-fluid">
    
    <div class="span12">
        
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Application Form - 8 of 8</h3>
            </div>
            <div class="box-content">
                 <h4><i class="glyphicon-book_open"></i> Previous School(s) Attended</h4>
                 
                <form class="form-horizontal form-column form-bordered" 
                    method="POST" 
                    action="<?php echo site_url('admission/submit/prev_qualif')?>">
                   <p class="alert alert-warning"> 
                     Note!  if Previous Qualification you are
                     submitting is still with the O'level and A'level
                     you cant leave Grade pass Blank. 
                   </p>
                    <div class="row-fluid">
                       <div class="span12">
                            <div class="row-fluid">
                                
                                 <table class="table table-bordered table-condensed table-striped">
                                    <thead>
                                        <tr>
                                            <th colspan="7" >Previous Qualification  
                                                <div class="input-prepend">
                                                    <span class="add-on">Add more fields : </span>
                                                    <input type="number" class=" input-mini" ng-model="unit" min="1" name="unit">
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td width='5%'>S/n</td>
                                            <td width='30%'>School Name</td>
                                            <td width='20%'>School Address</td>
                                            <td width='10%'>Certificate</td>
                                            <td width='5%'>Grade</td>
                                            <td width='10%'>From</td>
                                            <td width='10%'>To</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="d in dt">
                                            <td>{{$index + 1}}</td>
                                            <td>
                                                <input type="text" name="prev_qualif[school][{{$index}}]" class="input-large">
                                            </td>
                                            <td>
                                                <textarea name="prev_qualif[address][{{$index}}]" class="input-large"></textarea>
                                            </td>
                                            <td>
                                                <input type="text" name="prev_qualif[cert][{{$index}}]" class=" input-medium ">
                                                
                                            </td>
                                            <td>
                                                <select name="prev_qualif[grade][{{$index}}]" class=" input-medium ">
                                                    <option value=""> -- Choose Grade -- </option>
                                                    <option value="Distinction">Distinction</option>
                                                    <option value="Upper-Credit">Upper-Credit</option>
                                                    <option value="Lower-Credit">Lower-Credit</option>
                                                    <option value="Merit">Merit</option>
                                                    <option value="Pass">Pass</option>
                                                    <option value="none">Not Applicable</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="date" name="prev_qualif[year][{{$index}}]" class=" input-medium">
                                            </td>
                                            <td>
                                                <input type="date" name="prev_qualif[year][{{$index}}]" class=" input-medium">
                                            </td>
                                        </tr>
                                    </tbody>
                            </table>
                                
                            </div>
                            <p>&nbsp;</p>
                        </div>       
                    </div>
                    <input type="hidden" name="formnum" value="9">
                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit">Submit Application</button>
                        <button class="btn" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var state = <?php echo (is_array($state['rs']))? json_encode($state['rs']): '[]'?>;
    var lga = <?php echo (is_array($lga['rs']))? json_encode($lga['rs']): '[]'?>;
    var exam_groups = <?php echo (is_array($exam_group['rs']))? json_encode($exam_group['rs']): '[]'?>;
    var exam_type_period = <?php echo (is_array($exam_type_period['rs']))? json_encode($exam_type_period['rs']): '[]'?>;
    var exam_subjects = <?php echo (is_array($exam_subject['rs']))? json_encode($exam_subject['rs']): '[]'?>;
    var exam_grades = <?php echo (is_array($exam_grade['rs']))? json_encode($exam_grade['rs']): '[]'?>;
</script>
