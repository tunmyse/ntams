<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Prospective View Registration Form
 * 
 * @category   View
 * @package    Admission
 * @subpackage Prospective registaration
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

//var_dump($prev_qual);
?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Application From</h3>
                <div class="left actions">
                    <a class="btn btn-success " href="<?= site_url("admission/{$record['userid']}/print/form")?>" target="_blank"><i class="icon-print"></i> Print Form</a>
                        
                </div>
            </div>
            <div class="box-content">
                <table class="table table-condensed table-striped table-bordered table-colored-header">
                    <thead>
                        <tr>
                            <th colspan="4">Personal Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">
                                
                                <table>
                                    <tr >
                                        <td><div style="width: 200px; height: 150px;" class="fileupload-new thumbnail "><img style="width: 197px; height: 140px;" src="<?= $url?>"></div></td>
                                        <td style="text-align: center; vertical-align: middle; font-size: 25px">
                                            &nbsp;
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            
                        </tr>
                        <tr>
                            <th width="50">Surname: </th>
                            <td width="150"><?= ucfirst($record['fname'])?></td>
                            <th width="50">Other Name: </th>
                            <td width="150"><?= ucfirst($record['lname'].' '.$record['mname'])?></td>
                        </tr>
                        <tr>
                            <th width="50">E-mail: </th>
                            <td width="150"><?= $record['email']?></td>
                            <th width="50">Phone: </th>
                            <td width="150"><?= $record['phone']?></td>
                        </tr>
                        <tr>
                            <th width="50">Date of Birth : </th>
                            <td width="150"><?= date("D, d-m-Y", strtotime($record['dob']) ) ?></td>
                            <th width="50">Sex: </th>
                            <td width="150"><?= $record['sex']?></td>
                        </tr>
                        <tr>
                            <th width="50">Contact Address: </th>
                            <td width="150"><?= $record['address'] ?></td>
                            <th width="50">Religion : </th>
                            <td width="150"><?= $record['religion']?></td>
                        </tr>
                        <tr>
                            <th width="50">State of Origin : </th>
                            <td width="150"><?= $record['statename'] ?></td>
                            <th width="50">L.G.A : </th>
                            <td width="150"><?= $record['lganame']?></td>
                        </tr>
                        <tr>
                            <th width="50">Nationality : </th>
                            <td width="150"><?= $record['nationality'] ?></td>
                            <th width="50">Blood Group : </th>
                            <td width="150"><?= $record['blood']?></td>
                        </tr>
                        <tr>
                            <th width="50">Marital Status : </th>
                            <td width="150"><?= $record['marital'] ?></td>
                            <th width="50">Hobby : </th>
                            <td width="150"><?= $record['hobby'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <p>&nbsp;</p>
                <table class="table table-condensed table-striped table-bordered table-colored-header">
                    <thead>
                        <tr>
                            <td colspan="2">Next of Kin / Sponsor's Information</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="50%">
                                <table class="table table-condensed table-striped table-bordered ">
                                    <thead>
                                        <tr>
                                            <td colspan="2">Next of Kin</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width="25%">Surname :</th>
                                            <td width="75%"><?= $record['nkfname']?></td>
                                        </tr>
                                        <tr>
                                            <th>Other Names :</th>
                                            <td><?= $record['nkoname']?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone :</th>
                                            <td><?= $record['nkphone']?></td>
                                        </tr>
                                        <tr>
                                            <th>Mail :</th>
                                            <td><?= $record['nkmail']?></td>
                                        </tr>
                                        <tr>
                                            <th>Address :</th>
                                            <td><?= $record['nkaddress']?></td>
                                        </tr>
                                        <tr>
                                            <th>Relationship with Kin :</th>
                                            <td><?= $record['nkrelation']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            
                            <td width="50%">
                                <table id="tbl1" class="table table-condensed table-striped table-bordered ">
                                    <thead>
                                        <tr>
                                            <td colspan="2">Sponsor</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width="25%">Full Name :</th>
                                            <td width="75%"><?= $record['spname']?></td>
                                        </tr>
                                        <tr>
                                            <th>Address :</th>
                                            <td><?= $record['spaddress']?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone :</th>
                                            <td><?= $record['spphone']?></td>
                                        </tr>
                                        <tr>
                                            <th>E-mail :</th>
                                            <td><?= $record['spemail']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>&nbsp;</p>
                <table class="table table-condensed table-striped table-bordered table-colored-header">
                    <thead>
                        <tr>
                            <td colspan="2">O'level Results</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> 
                                <table width="100%" class="table table-condensed table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2">O'Level Sitting 1</th>
                                        </tr>
                                    </thead>
                                    <?php if(!empty($olevel1)){?>
                                    <tbody>
                                        <tr>
                                            <th width="25%">Exam Type:</th>
                                            <td colspan="2"><?= $olevel1[0]['shortname']?></td>
                                        </tr>
                                        <tr>
                                            <th>Exam Year:</th>
                                            <td colspan="2"><?= $olevel1[0]['examyear']?></td>
                                        </tr>
                                        <tr>
                                            <th>Exam No:</th>
                                            <td colspan="2"><?= $olevel1[0]['examnumber']?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table width="50%" class="table table-condensed table-striped table-bordered" style="font-size: 15px">
                                                    <tr>
                                                        <th>S/N</th>
                                                        <th>Subject</th>
                                                        <th>Grade</th>
                                                    </tr>
                                                    <tbody>
                                                        <?php foreach($olevel1 AS $key => $olv){?>
                                                        <tr>
                                                            <td><?= ++$key?></td>
                                                            <td><?= $olv['subname']?></td>
                                                            <td><?= $olv['gradename']?></td>
                                                        </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table> 
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php }else{?>
                                    <tbody>
                                        <tr>
                                            <td colspan="2"> No O'level Result Submitted</td>
                                        </tr>
                                    </tbody>
                                    <?php }?>
                                </table>
                            </td>
                            <td > 
                                <table width="50%" class="table table-condensed table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2">O'Level Sitting 2</th>
                                        </tr>
                                    </thead>
                                    <?php if(!empty($olevel2)){?>
                                    <tbody>
                                        <tr>
                                            <th width="25%">Exam Type:</th>
                                            <td colspan="2"><?= $olevel2[0]['shortname']?></td>
                                        </tr>
                                        <tr>
                                            <th>Exam Year:</th>
                                            <td colspan="2"><?= $olevel2[0]['examyear']?></td>
                                        </tr>
                                        <tr>
                                            <th>Exam No:</th>
                                            <td colspan="2"><?= $olevel2[0]['examnumber']?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table width="100%" class="table table-condensed table-striped table-bordered">
                                                    <tr>
                                                        <th>S/N</th>
                                                        <th>Subject</th>
                                                        <th>Grade</th>
                                                    </tr>
                                                    <tbody>
                                                        <?php foreach($olevel2 AS $key => $olv){?>
                                                        <tr>
                                                            <td><?= ++$key?></td>
                                                            <td><?= $olv['subname']?></td>
                                                            <td><?= $olv['gradename']?></td>
                                                        </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table> 
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php }else{?>
                                    <tbody width="100%">
                                        <tr>
                                            <td colspan="2" width="100%"> No O'level Result Submitted</td>
                                        </tr>
                                    </tbody>
                                    <?php }?>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>&nbsp;</p>
                <table class="table table-condensed table-striped table-bordered table-colored-header">
                    <thead>
                        <tr>
                            <th colspan="2">UTME Result / Programme Choice</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width='50%'>
                                <table class="table table-condensed table-striped table-bordered ">
                                    <thead>
                                        <tr>
                                            <th colspan="2">UTME Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width='25%'>UTME Reg.Id</th>
                                            <td><?= $utme[0]['regid']?></td>
                                        </tr>
                                        <tr>
                                            <th>Year</th>
                                            <td><?= $utme[0]['year']?></td>
                                        </tr>
                                        <tr> 
                                            <td colspan="2">
                                                <table class="table table-condensed table-striped table-bordered">
                                                    <tr>
                                                        <th>S/N</th>
                                                        <th>Subject</th>
                                                        <th>Score</th>
                                                    </tr>
                                                    <tbody>
                                                        <?php 
                                                            $total = 0;
                                                            
                                                            foreach($utme AS $key => $olv){
                                                            $total += $olv['score'];
                                                        ?>
                                                        
                                                        <tr>
                                                            <td><?= ++$key?></td>
                                                            <td><?= $olv['subname']?></td>
                                                            <td><?= $olv['score']?></td>
                                                        </tr>
                                                        <?php }?>
                                                        <tr>
                                                            <th colspan="2">Aggregate :</th>
                                                            <td><?= $total?></td>
                                                        </tr>
                                                    </tbody>
                                                </table> 
                                            </td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td width='50%'>
                                <table class="table table-condensed table-striped table-bordered ">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Programme Choice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width='25%'>Choice 1</th>
                                            <td><?= $record['prg1']?></td>
                                        </tr>
                                        <tr>
                                            <th>Choice 2</th>
                                            <td><?= $record['prg2']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>&nbsp;</p>
                <table class="table table-bordered table-colored-header table-condensed table-striped">
                    <thead>
                        <tr>
                            <th colspan="6">Previous School Attended </th> 
                        </tr>
                    </thead>
                    <tr>
                            <th>S/n</th>
                            <th>School / Institution Name</th>
                            <th>Address</th>
                            <th>Certificate Obtained</th>
                            <th>Grade</th>
                            <th>Year</th>
                        </tr>
                    <tbody>
                        <?php foreach($prev_qual as $key => $pq ):?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $pq['schoolname']?></td>
                            <td><?= $pq['schladdress']?></td>
                            <td><?= $pq['certificate']?></td>
                            <td><?= $pq['grade']?></td>
                            <td><?= $pq['year']?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
