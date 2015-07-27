<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Payment  
 * 
 * @category   View
 * @package    Payment
 * @subpackage 
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
//var_dump($elig_schedule);
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
                                <li class="">
                                        <a data-toggle="tab" href="#t3">Third tab</a>
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
                                                if(count($elig_schedule) > 0){
                                                    
                                                    foreach ($elig_schedule as $key => $value) { ?>

                                                        <tr>
                                                            <td><?php echo $key +1?></td>
                                                            <td><?php echo $value['sesname']?></td>
                                                            <td><?php echo ucfirst($value['type'])?></td>
                                                            <td>
                                                                <a href="<?php echo base_url(sprintf('payment/paynow/%s',$value['scheduleid']))?>" class="btn btn-lime">Proceed to Payment</a>
                                                            </td>
                                                        </tr>

                                                     <?php 

                                                    } 
                                                }else{
                                                 ?>
                                                <tr>
                                                    <td colspan="5" ><span style="color: brown">You do Not have any pending payment to make</span> </td>
                                                </tr>
                                                <?php }?>
                                                    
                                            </tbody>
                                        </table>
                                </div>
                                <div id="t2" class="tab-pane">
                                    <h4><i class="icon-list-alt"></i> Payment History</h4>
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
                                                <?php foreach($my_pay_history as  $k => $ph){?>
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
                                                        <a href="#" class="btn btn-blue btn-small"><i class="icon-print"></i> Print</a>
                                                        <?php }?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                </div>
                                <div id="t3" class="tab-pane">
                                        <h4>Another tab</h4>
                                        Lorem ipsum commodo dolor sit in sint
                                        anim ad ut non et. Lorem ipsum cillum ex sunt ea irure Ut 
                                        dolore in labore officia nostrud in anim culpa sit esse. Lorem 
                                        ipsum elit Duis magna et voluptate Duis non pariatur esse laboris 
                                        nisi laborum nulla. Lorem ipsum et tempor ea ad in id consectetur 
                                        incididunt velit Excepteur officia. Lorem ipsum non consectetur 
                                </div>
                        </div>
                </div>
        </div>
</div>