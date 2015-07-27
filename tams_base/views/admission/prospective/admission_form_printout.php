<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="span" style="text-align: center"><h4>efwjehrkjwe</h4></div>
<table class="table table-condensed ">
    <tr>
        <td>
            <table class="table table-condensed table-colored-header table-bordered table-striped">
                <thead>
                    <tr>
                        <th colspan="2">Personal Info</th>  
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="5" width="20%">
                            <div style="width: 150px; height: 140px;" class="fileupload-new thumbnail">
                                <img style="width: 150px; height: 140px;" src="<?= $url?>">
                            </div>
                        </td>   
                    </tr>
                    <tr>
                        <th width="12%">Surname :</th>
                        <td width="28%"><?= ucfirst($record['fname'])?> </td>
                        <th width="13%">Other Name :</th>
                        <td width="27%"><?= ucfirst($record['lname'].' '.$record['mname'])?></td>
                    </tr>
                    <tr>
                        <th>E-mail :</th>
                        <td><?= $record['email']?></td>
                        <th>Phone :</th>
                        <td><?= $record['phone']?></td>
                    </tr>
                    <tr>
                        <th>DoB :</th>
                        <td><?= date("D, d-m-Y", strtotime($record['dob']) ) ?></td>
                        <th>Sex :</th>
                        <td><?= $record['sex']?></td>
                    </tr>
                    <tr>
                        <th>Blood Group :</th>
                        <td><?= $record['blood']?></td>
                        <th>Religion </th>
                        <td><?= $record['religion']?></td>
                    </tr>
                    <tr>
                        <th>Address :</th>
                        <td colspan="2"><?= $record['address']?></td>
                        <th>Sate of Origin </th>
                        <td><?= $record['statename']?></td>
                    </tr>
                    <tr>
                        <th>Hobbies :</th>
                        <td colspan="2"><?= $record['hobby']?></td>
                        <th>LGA :</th>
                        <td><?= $record['lganame']?></td>
                    </tr>
                    <tr>
                        <th>Nationality :</th>
                        <td colspan="2"><?= $record['nationality']?></td>
                        <th>Marital :</th>
                        <td><?= $record['marital']?></td>
                    </tr>
                    
                </tbody>

            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table class="table table-condensed table-colored-header table-bordered table-striped">
                <thead>
                    <tr>
                        <th colspan="2">Sponsor's / Next of Kin Info</th>  
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="50%">
                            <table class="table table-condensed table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">Next of Kin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th width="27%">Surname :</th>
                                        <td width="73%"><?= $record['nkfname']?></td>
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
                            <table  class="table table-condensed table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th colspan="2">Sponsor</th>
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
        </td>
    </tr>
    <tr>
        <td>
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
                                
                                <tbody>
                                    <tr>
                                        <th width='25%'> Programme Choice 1</th>
                                        <td><?= $record['prg1']?></td>
                                    </tr>
                                    <tr>
                                        <th>Programme Choice 2</th>
                                        <td><?= $record['prg2']?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
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
        </td>
    </tr>
    <tr>
        <td>
            <table class="table table-condensed table-colored-header table-bordered table-striped">
                <thead>
                    <tr>
                        <th colspan="2">O'Level Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width='50%'>
                            <table class="table table-condensed table-colored-header table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">Sitting 1</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th width='25%'>Exam Type :</th>
                                        <td width='75%'><?= (!empty($olevel1))? $olevel1[0]['shortname'] : ''?></td>
                                    </tr>
                                    <tr>
                                        <th>Exam Year :</th>
                                        <td><?= (!empty($olevel1))? $olevel1[0]['examyear'] : ''?></td>
                                    </tr>
                                    <tr>
                                        <th>Exam No :</th>
                                        <td><?= (!empty($olevel1))? $olevel1[0]['examnumber'] : ''?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table class="table table-condensed table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>S/n</th>
                                                        <th>Subjects</th>
                                                        <th>Grades</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(!empty($olevel1)){
                                                        
                                                        foreach($olevel1 AS $key => $olv):
                                                        ?>
                                                            <tr>
                                                               <td><?= ++$key?></td>
                                                                <td><?= $olv['subname']?></td>
                                                                <td><?= $olv['gradename']?></td>
                                                            </tr>
                                                    <?php 
                                                        endforeach;
                                                    }else{?>
                                                    <tr>
                                                        <td colspan="3">No Record Found </td>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td width='50%'>
                            <table class="table table-condensed table-colored-header table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">Sitting 2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Exam Type :</th>
                                        <td><?= (!empty($olevel2))? $olevel2[0]['shortname'] : ''?></td>
                                    </tr>
                                    <tr>
                                        <th>Exam Year :</th>
                                        <td><?= (!empty($olevel2))? $olevel2[0]['examyear'] : ''?></td>
                                    </tr>
                                    <tr>
                                        <th>Exam No :</th>
                                        <td><?= (!empty($olevel2))? $olevel2[0]['examnumber'] : ''?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table class="table table-condensed table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>S/n</th>
                                                        <th>Subjects</th>
                                                        <th>Grades</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(!empty($olevel2)){
                                                        
                                                        foreach($olevel2 AS $key2 => $olv2):
                                                        ?>
                                                            <tr>
                                                                <td><?= ++$key2?></td>
                                                                <td><?= $olv2['subname']?></td>
                                                                <td><?= $olv2['gradename']?></td>
                                                            </tr>
                                                    <?php 
                                                        endforeach;
                                                    }else{?>
                                                    <tr>
                                                        <td colspan="3" >No Record Found </td>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    
</table>
