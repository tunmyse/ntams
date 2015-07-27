<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Admission status
 * 
 * @category   View
 * @package    Admission
 * @subpackage Prospective registaration
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
//var_dump($user_details);
?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3><i class="icon-user"></i>Applicant Information</h3>
            </div>
            <div class="box-content">
                <form 
                    class="form-horizontal form-column form-bordered form-inline" 
                    method="POST" 
                    action="<?= site_url(sprintf('admission/updateform/1/%d',$applicant['userid']))?>">
                        <div class="span12">
                                <div class="control-group">
                                        <label class="control-label" for="textfield">Full Name</label>
                                        <div class="controls">
                                                <?= $applicant['fname'] . ' ' .$applicant['lname'].' '. $applicant['mname']?>
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label class="control-label" for="password">Phone Number</label>
                                        <div class="controls">
                                            <?= $applicant['phone']?>
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label class="control-label"> E-mail</label>
                                        <div class="controls">
                                             <?= $applicant['email']?>   
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label class="control-label" for="textarea">Application Type </label>
                                        <div class="controls">
                                           <?= $applicant['sesname'] . ' ' .$applicant['displayname'].' ( '. $applicant['type']. ' )'?>     
                                        </div>
                                </div>
                        </div>
                        
                        <div class="span12">
                                <div class="form-actions">
                                        <button class="btn btn-primary" type="submit">Proceed with Application</button>
                                       
                                </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
