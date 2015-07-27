<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Prospective Registartion form Submit utme result 
 * 
 * @category   View
 * @package    Admission
 * @subpackage Prospective registaration
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */



?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Application Form - 3 of 8</h3>    
            </div>
            <div class="box-content">
                <h4 class="span"><i class="glyphicon-book"></i> UTME Details  </h4>
                    
                    <div class="span">
                        <?php if(empty($utme)){?>

                        <form class="form-horizontal form-bordered" 
                            method="POST" 
                            action="<?php echo site_url('admission/submit/utme')?>">
                            <div class="span11">
                                <table class="table table-bordered table-condensed table-striped table-colored-header">
                                    <thead>
                                        <tr>
                                            <th colspan="2">UTME Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width='25%'>Exam Year :</td>
                                            <td>
                                                <div class='span4'>
                                                    <select name="utme[examyr]" id="olevel[0][examyr]" class="input-large" required="" >
                                                        <option value="">--Exam Year--</option>
                                                        <?php 
                                                        $i =0;
                                                        do{
                                                           $year = $this_year - $i;  
                                                        ?>
                                                        <option value="<?php echo $year?>"><?php echo $year?></option>
                                                        <?php 
                                                        $i++;
                                                        }while($i <= 1)?>
                                                    </select>
                                                </div>
                                            </td>   
                                        </tr>
                                        <tr>
                                            <td width='25%'>Exam Number :</td>
                                            <td>
                                                <div class='span4'>
                                                    <input type="text" name="utme[examnum]" value="<?= $applicant['jambregid']?>" id="examnum[first]" placeholder="Exam No" class="input-large" required="true">
                                                </div>
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
                                                                <div class="span6">
                                                                    <select name="utme[subject][]" class="input-large">
                                                                        <option value="">--Subject--</option>
                                                                        <?php foreach($subjects['rs'] AS $sbj){?>
                                                                        <option value="<?php echo $sbj['subid']?>" ><?php echo $sbj['subname']?></option>
                                                                        <?php }?>
                                                                    </select> 
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="utme[grade][]" class="input-small" min="0" max="100">
                                                            </td>
                                                        </tr>
                                                        <?php 
                                                        $i++;
                                                        }while($i < 4)?>
                                                    </body>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-actions">
                                    <button class="btn btn-primary" type="submit">Save and Proceed</button>
                                    <button class="btn" type="button">Cancel</button>
                                </div> 
                            </div>
                            <input type="hidden" name="formnum"  value='3'>
                        </form>

                        <?php }else{?>
                        
                        <form class="form-horizontal form-bordered" 
                            method="POST" 
                            action="<?= site_url(sprintf('admission/updateform/3/%d',$applicant['userid']))?>">

                            <div class="span11"> 
                                <table class="table table-bordered table-striped table-condensed" >
                                    <thead>
                                        <tr>
                                            <th colspan="2">UTME Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="30%">Exam No.</td>
                                            <td><?= $utme[0]['regid']?></td>
                                        </tr>
                                        <tr>
                                            <td>Exam Year.</td>
                                            <td><?=  $utme[0]['year']?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th width="5%">S/n</th>
                                                            <th>Subject</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $tot = 0;
                                                        foreach($utme as $key => $ut):
                                                            $tot = $tot + $ut['score'];
                                                            ?>

                                                        <tr>
                                                             <td><?= ++$key ?></td>
                                                            <td><?= $ut['subname']?></td>
                                                            <td><?= $ut['score']?></td>
                                                        </tr>
                                                        <?php endforeach;?>
                                                        <tr>
                                                             <td>&nbsp</td>
                                                             <td style="color: blue; font-weight: bold">Aggregate </td>
                                                            <td style="color: blue; font-weight: bold"><b><?= $tot?></b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <input type="hidden" name="utme"  value='yes'>
                                        <input type="hidden" name="uploaded"  value='yes'>
                                    </tbody>
                                </table>
                                <div class="form-actions">
                                    <button class="btn btn-primary" type="submit">Proceed</button>
                                    
                                </div> 
                            </div>

                        </form>
                        <?php }?>
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