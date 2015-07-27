<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Payment  
 * 
 * @category   View
 * @package    Payment reciept
 * @subpackage 
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
//var_dump($trans_details);
//exit();
?>
<div class="span12">
    <div class="box box-bordered box-color">
        <div class="box-title" style="text-align: center">
            <h2><i class="icon-credit-card"></i><?= strtoupper($trans_details['sesname'] . ' '. $trans_details['type']. ' Receipt' )?></h2>
        </div>
        <hr>
        <div class="box-content">
            
            <table class="table table-bordered table-striped" width="690">
                <tbody>
                    <tr>
                        <th width="25%">Matric No</th>
                        <td><?= $trans_details['usertypeid']?></td>
                        <td width="30%" rowspan="4" style=" font-size: 80px; vertical-align: middle; text-align: center">
                            <barcode code="<?= $trans_details['usertypeid'].'-'.$trans_details['sesname'] . ' '. $trans_details['type']?>" 
                                     type="QR" 
                                     class="barcode" size="1.7" error="M" />
                        </td>
                    </tr>
                    <tr>
                        <th>Full Name</th>
                        <td><?= strtoupper($trans_details['fname'] . ' '. $trans_details['lname'] . ' '.$trans_details['mname'])?></td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td><?= ($trans_details['usertype'] == 'applicant')? '0 L' : $trans_details['level'].'00 L' ?></td>
                    </tr>
                    <tr>
                        <th>Payment Description</th>
                        <td><?= $trans_details['sesname'] . ' '. $trans_details['type']?></td>
                    </tr>
                    <tr>
                        <th>Payment Reference</th>
                        <td><?= $trans_details['reference'] ?></td>
                        <td rowspan="4" style=" font-size: 60px; font-weight: bold; vertical-align: middle; text-align: center">
                            <?= $trans_details['percentage'].' %'?>
                        </td>
                    </tr>
                    <tr>
                        <th>Date Time</th>
                        <td><?= $trans_details['date_time']?></td>
                    </tr>
                    <tr>
                        <th>Actual Amount</th>
                        <td style="color: blue"><?= 'NGN '.number_format($trans_details['amt'], 2) ?></td>
                    </tr>
                    <tr>
                        <th>Penalty </th>
                        <td style="color: red"><?= 'NGN '.number_format($trans_details['penalty'], 2) ?></td>
                    </tr>
                    <tr>
                        <th>Total Paid </th>
                        <td style="color: green" colspan="2"><?= 'NGN '.number_format($trans_details['penalty'] + $trans_details['amt'], 2) ?></td>
                    </tr>  
                </tbody>
            </table>
        </div>
    </div>
</div>