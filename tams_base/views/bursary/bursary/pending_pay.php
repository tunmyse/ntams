<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Bursary 
 * 
 * @category   View
 * @package    Pending Payment
 * @subpackage 
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
//var_dump($pay_history);
//exit();
?>
<div class="span12">
        <div class="box box-bordered box-color">
                <div class="box-title">
                    <h3>
                        <i class="icon-money"></i>
                        Payment 
                    </h3>
                    <ul class="tabs">
                        <li class="active">
                                <a data-toggle="tab" href="#t1">Pending Payment</a>
                        </li>
                        <li class="">
                                <a data-toggle="tab" href="#t2">Payment History</a>
                        </li>    
                    </ul>
                </div>
                <div class="box-content">
                        <div class="tab-content">
                                <div id="t1" class="tab-pane active">
                                        <h4>Pending Payment</h4>
                                        <table class="table table-condensed table-striped table-bordered table-condensed table-striped">
                                            <thead>
                                                <th>S/N</th>
                                                <th>Session</th>
                                                <th>Payment Description </th>
                                                <th>&nbsp;</th>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if(count($schedule) > 0){
                                                    
                                                    foreach ($schedule as $key => $value): ?>

                                                        <tr>
                                                            <td><?= $key +1?></td>
                                                            <td><?= $value['sesname']?></td>
                                                            <td><?= ucfirst($value['type'])?></td>
                                                            <td>
                                                                <a href="<?php echo base_url(sprintf('bursary/paynow/%s/%s',$value['scheduleid'],$value['payid'] ))?>" class="btn btn-lime">Proceed to Payment</a>
                                                            </td>
                                                        </tr>

                                                     <?php
                                                    endforeach; 
                                                    
                                                }
                                                else{
                                                    ?>
                                                   <tr>
                                                       <td colspan="5"  style="text-align: center"><span style="color: brown">You do Not have any pending payment to make</span> </td>
                                                   </tr>
                                                   <?php }?>
                                                    
                                            </tbody>
                                        </table>
                                </div>
                                <div id="t2" class="tab-pane">
                                    <h4><i class="icon-list-alt"></i> Payment History</h4>
                                    <?php if(!empty($pay_history)){?>
                                        <table class="table dataTable dataTables_paginate dataTables_filter">
                                            <thead>
                                                <th width="3">S/N</th>
                                                <th width="5">Session</th>
                                                <th width="7">Payment Head</th>
                                                <th>Transaction Reference</th>
                                                <th>Date Time</th>
                                                <th>Amount</th>
                                                <th>percentage</th>
                                                <th>Status</th>
                                                <th>Receipt</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($pay_history as  $k => $ph){?>
                                                <tr>
                                                    <td><?php echo $k+1;?></td>
                                                    <td><?php echo $ph['sesname'];?></td>
                                                    <td><?php echo $ph['type'];?></td>
                                                    <td><?php echo $ph['reference'];?></td>
                                                    <td><?php echo $ph['date_time'];?></td>
                                                    <td><?php echo number_format($ph['amt'], 2);?></td>
                                                    <td><?php echo $ph['status'];?></td>
                                                    <td><?php echo $ph['percentage']. ' %';?></td>
                                                    <td>
                                                        <?php if($ph['status'] == 'APPROVED'){?>
                                                        <a href="<?php echo base_url(sprintf('bursary/receipt/%s',$ph['ordid']))?>" target="_blank" class="btn btn-blue btn-small"><i class="icon-print"></i> Print</a>
                                                        <?php }?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php }else {?>
                                        <div class="alert alert-error center">
                                            No Record Found 
                                        </div>
                                    <?php }?>
                                </div>
                                
                        </div>
                </div>
        </div>
</div>