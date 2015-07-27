<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Prospective Registartion form 3 
 * 
 * @category   View
 * @package    Admission
 * @subpackage Prospective registaration
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

//var_dump($subjects['rs']);
?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Application Form - 5 of 8 </h3>
            </div>
            <div class="box-content">
                <h4 class="span"><i class="glyphicon-book"></i> O'Level Result </h4>
                <form class="form-horizontal form-column form-bordered" 
                    method="POST" 
                    action="<?php echo site_url('admission/submit/olevel')?>">
                    <div class="row-fluid">
                        <div class='span12'>
                            <div class="row-fluid">
                                <div class="span6">
                                    <p>&nbsp;</p>
                                    <table class="table table-bordered table-condensed table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="2">O'Level Result sitting 1</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width='25%'>Exam Type :</td>
                                                <td>
                                                    <div class='span5'>
                                                        <select name="olevel[0][examtype]"  class="input-large chosen-select" >
                                                            <option value="">--Exam Type--</option>
                                                            <?php foreach ($exam_type_period['rs'] as $ex){?>
                                                            <option  value="<?php echo $ex['examid']?>"><?php echo $ex['shortname']?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </td>   
                                            </tr>
                                            <tr>
                                                <td width='25%'>Exam Year :</td>
                                                <td>
                                                    <div class='span4'>
                                                        <select name="olevel[0][examyr]" id="olevel[0][examyr]" class="input-large chosen-select" >
                                                            <option value="">--Exam Year--</option>
                                                            <?php 
                                                            $i =0;
                                                            do{
                                                               $year = $this_year - $i;  
                                                            ?>
                                                            <option value="<?php echo $year?>"><?php echo $year?></option>
                                                            <?php 
                                                            $i++;
                                                            }while($i <= 30)?>
                                                        </select>
                                                    </div>
                                                </td>   
                                            </tr>
                                            <tr>
                                                <td width='25%'>Exam Number :</td>
                                                <td>
                                                    <div class='span4'>
                                                        <input type="text" name="olevel[0][examnum]" id="examnum[first]" placeholder="Exam No " class="input-large">
                                                    </div>
                                                    <input type="hidden" name="olevel[0][sitting]" value="1">
                                                </td>   
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>s/n</th>
                                                                <th>Subject</th>
                                                                <th>Grade</th>
                                                            </tr>
                                                        </thead>
                                                        <body>
                                                            <?php 
                                                            $i = 0;
                                                            do{?>
                                                            <tr>
                                                                <td><?php echo $i +1?></td>
                                                                <td>
                                                                    <select name="olevel[0][subject][]">
                                                                        <option value="">--Subject--</option>
                                                                        <?php foreach($subjects['rs'] AS $sbj){?>
                                                                        <option value="<?php echo $sbj['subid']?>" ><?php echo $sbj['subname']?></option>
                                                                        <?php }?>
                                                                    </select> 
                                                                </td>
                                                                <td>
                                                                    <select name="olevel[0][grade][]" class="input-small">
                                                                        <option value="">--Grade--</option>
                                                                        <?php foreach($grade['rs'] AS $grd){?>
                                                                        <option value="<?php echo $grd['gradeid']?>"><?php echo $grd['gradename']?></option> 
                                                                        <?php }?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <?php 
                                                            $i++;
                                                            }while($i < 9)?>
                                                        </body>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="span6">
                                    <p>&nbsp;</p>
                                    <table class="table table-bordered table-condensed table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="2">O'Level Result sitting 2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width='25%'>Exam Type :</td>
                                                <td>
                                                    <div class='span5'>
                                                        <select name="olevel[1][examtype]"  class="input-large chosen-select" >
                                                            <option value="">--Exam Type--</option>
                                                            <?php foreach ($exam_type_period['rs'] as $ex){?>
                                                            <option  value="<?php echo $ex['examid']?>"><?php echo $ex['shortname']?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </td>   
                                            </tr>
                                            <tr>
                                                <td width='25%'>Exam Year :</td>
                                                <td>
                                                    <div class='span4'>
                                                        <select name="olevel[1][examyr]" id="olevelexamyr1" class="input-large chosen-select" >
                                                            <option value="">--Exam Year--</option>
                                                            <?php 
                                                            $i =0;
                                                            do{
                                                               $year = $this_year - $i;  
                                                            ?>
                                                            <option value="<?php echo $year?>"><?php echo $year?></option>
                                                            <?php 
                                                            $i++;
                                                            }while($i <= 30)?>
                                                        </select>
                                                    </div>
                                                </td>   
                                            </tr>
                                            <tr>
                                                <td width='25%'>Exam Number :</td>
                                                <td>
                                                    <div class='span4'>
                                                        <input type="text" name="olevel[1][examnum]" id="examnum" placeholder="Exam No " class="input-large">
                                                    </div>
                                                    <input type="hidden" name="olevel[1][sitting]" value="2">
                                                </td>   
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>s/n</th>
                                                                <th>Subject</th>
                                                                <th>Grade</th>
                                                            </tr>
                                                        </thead>
                                                        <body>
                                                            <?php 
                                                            $i = 0;
                                                            do{?>
                                                            <tr>
                                                                <td><?php echo $i +1?></td>
                                                                <td>
                                                                    <select name="olevel[1][subject][]">
                                                                        <option value="">--Subject--</option>
                                                                        <?php foreach($subjects['rs'] AS $sbj){?>
                                                                        <option value="<?php echo $sbj['subid']?>" ><?php echo $sbj['subname']?></option>
                                                                        <?php }?>
                                                                    </select> 
                                                                </td>
                                                                <td>
                                                                    <select name="olevel[1][grade][]" class="input-small">
                                                                        <option value="">--Grade--</option>
                                                                        <?php foreach($grade['rs'] AS $grd){?>
                                                                        <option value="<?php echo $grd['gradeid']?>"><?php echo $grd['gradename']?></option> 
                                                                        <?php }?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <?php 
                                                            $i++;
                                                            }while($i < 9)?>
                                                        </body>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>      
                    </div>
                    <input type="hidden" name="formnum" value="6">
                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit">Save and Proceed</button>
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