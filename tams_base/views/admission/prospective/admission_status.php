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
                <h3><i class="icon-th-list"></i> Admission Status Page</h3>
            </div>
            <div class="box-content">
                <table class="table table-condensed table-striped table-bordered">
                    <thead>
                        <tr>
                            <th colspan="4">Admission Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">
                                
                                <table>
                                    <tr >
                                        <td><div style="width: 200px; height: 150px;" class="fileupload-new thumbnail "><img style="width: 197px; height: 140px;" src="<?php echo $url?>"></div></td>
                                        <td style="text-align: center; vertical-align: middle; font-size: 25px">
                                            
                                            <?php if(!$user_details['admstatus']){?>
                                            
                                                <div class="span12 alert alert-warning"><i class="icon icon-warning-sign"></i> NO ADMISSION OFFERED YET</div>
                                            
                                            <?php }elseif($user_details['admstatus'] == 'Not Admitted'){?>
                                            
                                                <div class="span12 alert alert-danger"><i class="icon icon-warning-sign"></i> <?php echo $user_details['admstatus']?></div>
                                            
                                            <?php }else{?>
                                            
                                                <div class="span12 alert alert-success"><i class="icon icon-warning-sign"></i> <?php echo $user_details['admstatus']?></div>
                                                
                                            <?php }?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            
                        </tr>
                        <tr>
                            <th width="50">Surname: </th>
                            <td width="150"><?php echo $user_details['fname']?></td>
                            <th width="50">Other Names: </th>
                            <td width="150"><?php echo $user_details['lname'].' '.$user_details['mname']?></td>
                        </tr>
                        <tr>
                            <th width="50">E-mail: </th>
                            <td width="150"><?php echo $user_details['email']?></td>
                            <th width="50">Phone: </th>
                            <td width="150"><?php echo $user_details['phone']?></td>
                        </tr>
                        <tr>
                            <th width="50">Date of Birth: </th>
                            <td width="150"><?php echo date("D, d-m-Y", strtotime($user_details['dob']) ) ?></td>
                            <th width="50">SEX: </th>
                            <td width="150"><?php echo $user_details['sex']?></td>
                        </tr>
                        <tr>
                            <th width="50">Programme Choice 1: </th>
                            <td width="150"><?php echo $user_details['prg_chc1']?></td>
                            <th width="50">Programme Choice 2: </th>
                            <td width="150"><?php echo $user_details['prg_chc2']?></td>
                        </tr>
                        <tr>
                            <th width="50">Programme Offered: </th>
                            <td width="150" colspan="3"><?php echo ($user_details['offered'])?"<span style='color: green'>".$user_details['offered']."</span>" : "<span style='color: red'>NO PROGRAMME INFORMATION</span>"?></td> 
                        </tr>
                        <tr>
                            <td width="400" colspan="4" style="text-align: center">
                                <?php if($user_details['admstatus'] == 'Admitted'){?>
                                <a href="#" class="btn btn-grey">Print Admission Letter</a>
                                <?php }?>
                            </td> 
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
