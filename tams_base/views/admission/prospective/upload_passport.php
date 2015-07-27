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

//var_dump($exam_grade['rs']);
?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Application Form - 4 of 8</h3>
                
            </div>
            <div class="box-content">
                <h4 class="span"><i class="glyphicon-book"></i> Upload Passport</h4>
                <form class="form-horizontal form-column form-bordered" 
                    method="POST"
                    enctype="multipart/form-data"
                    action="<?php echo site_url('admission/submit/passport')?>">
                    <div class="row-fluid">
                        <div class='span12'>
                            <div class="row-fluid">
                                <div id="imagestatus" class="alert" style="display:none"></div>
                                <div class="control-group">
                                        <label class="control-label" for="textfield">Passport upload</label>
                                        <div class="controls">
                                                <div data-provides="fileupload" class="fileupload fileupload-new">
                                                    <input type="hidden">
                                                    <div style="width: 200px; height: 150px;" 
                                                         class="fileupload-new thumbnail">
                                                        
                                                        <img src="<?= $img_url?>"></div>
                                                    
                                                    <div style="max-width: 200px; max-height: 150px; line-height: 20px;" 
                                                         class="fileupload-preview fileupload-exists thumbnail"></div>
                                                    <div>
                                                        <span class="btn btn-file">
                                                            <span class="fileupload-new">Select image</span>
                                                            <span class="fileupload-exists">Change</span>
                                                            <input type="file" id="regpassport"  name="userfile">
                                                        </span>
                                                        <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
                                                    </div>
                                                </div>
                                        </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <input type="hidden" name="formnum" value="4">
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