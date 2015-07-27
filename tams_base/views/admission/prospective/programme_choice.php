<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Prospective Registartion form 4 
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
                <h3><i class="icon-th-list"></i> Prospective Registration Form - 7 of 8</h3>
            </div>
            <div class="box-content">
                <h4 class="span"><i class="glyphicon-book"></i> Programme Choice  </h4>
                <form class="form-horizontal form-bordered " 
                    enctype="multipart/form-data"
                    method="POST" 
                    action="<?php echo site_url('admission/submit/prog_choice')?>">
                    <div class="row-fluid">
                        <div class="span12 row">
                            <div class="span12">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <div class="control-group">
                                            <label class="control-label" for="prog1">First Choice of Programme</label> 
                                            <div class="controls">
                                                <select name="prog1"  class="chosen-select " id="firstprog" required="required">
                                                    <option value="">--Programme 1--</option>
                                                    <?php foreach($programmes['rs'] AS $prog){?>
                                                    <option value="<?php echo $prog['progid']?>"><?php echo $prog['progname']?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6">
                                        <div class="control-group">
                                            <label class="control-label" for="prog2">Second Choice of Programme</label> 
                                            <div class="controls">
                                                <select name="prog2"  class="chosen-select " id="secondprog" required="required">
                                                    <option value="">--Programme 1--</option>
                                                    <?php foreach($programmes['rs'] AS $prog){?>
                                                    <option value="<?php echo $prog['progid']?>"><?php echo $prog['progname']?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </div>
                       <br/>
                       <input type="hidden" name="formnum" value="8">
                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit">Save changes</button>
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