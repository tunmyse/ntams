<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Payment Managent 
 * 
 * @category   View
 * @package    Payment
 * @subpackage 
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

//var_dump($payschd);
?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3>
                    <i class="icon-money"></i>
                    Payment Management
                </h3>
                <ul class="tabs">
                    <?php if($this->main->has_perm('payment', 'payment.setup.view')){?>
                    <li>
                        <a href="#t6" class="active" data-toggle="tab">Register Merchant</a>
                    </li>
                    <?php }?>
                    
                    <?php if($this->main->has_perm('payment', 'payment.setup.view')){?>
                    <li>
                        <a  href="#t8"  data-toggle="tab">Pay Heads</a>
                    </li>
                    <?php }?>
                    
                    <?php if($this->main->has_perm('payment', 'payment.setup.view')){?>
                    <li>
                        <a href="#t10" data-toggle="tab">Installments</a>
                    </li>
                    <?php }?>
                    
                    <?php if($this->main->has_perm('payment', 'payment.setup.view')){?>
                    <li>
                        <a href="#t9" data-toggle="tab">Pay Schedule</a>
                    </li>
                    <?php }?>
                    
                    <?php if($this->main->has_perm('payment', 'payment.setup.view')){?>
                    <li>
                        <a href="<?= site_url('bursary/assign')?>" target="_new">Assign Schedule to Users</a>
                    </li>
                    <?php }?>
                </ul>
            </div>                                
            <div class="box-content nopadding">
                <div class="tab-content">
                    <div class="tab-pane active" id="t6">                                                                                       
                        <div class="tab-content">
                            <div class="box-content">
                                <ul class="tabs pull-right form"> 
                                    <?php if($this->main->has_perm('payment', 'payment.setup.create.merchant') 
                                            &&
                                            $this->main->has_perm('payment', 'payment.setup.view')){?>
                                    
                                    <li class="btn btn-lime" data-toggle="modal" href="#create_merchant_modal">
                                        <i class="icon-plus"> </i>
                                        Add Merchant
                                    </li>
                                    
                                    <?php }?>
                                </ul><br/><br/>
                                <?php if($this->main->has_perm('payment', 'payment.setup.view') && $this->main->has_perm('payment', 'payment.setup.view.merchant')){?>
                                <table id="all_merchant" class="table table-bordered table-condensed table-hover table-striped  dataTable dataTables_paginate dataTables_filter">
                                    <thead>
                                        <tr>
                                            <th width="5">S/N</th>
                                            <th>Merchant Name</th>
                                            <th>Contact Person</th>
                                            <th>Phone No</th>
                                            <th>E-mail</th>
                                            <th width="5">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="merchant in data.merchants">
                                            <td ng-bind="$index +1"></td>
                                            <td ng-bind="merchant.merchname"></td>
                                            <td ng-bind="merchant.contact"></td>
                                            <td ng-bind="merchant.phone"></td>
                                            <td ng-bind="merchant.email"></td>

                                            <td align="center">                                                               
                                               <div class="btn-group">
                                                    <a href="#" data-toggle="dropdown" class="btn  btn-lime dropdown-toggle"><i class="icon-cog"> </i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu">
                                                        <?php if($this->main->has_perm('payment', 'payment.setup.view')){?>
                                                        <li>
                                                            <a ng-click="openViewDialog('merchant', $index, $event)">View</a>
                                                        </li>
                                                        <?php }?>  
                                                        
                                                        <?php if($this->main->has_perm('payment', 'payment.setup.edit.merchant')){?>
                                                            <li>
                                                                <a ng-click="openEditDialog('merchant', $index, $event)">Edit</a>
                                                            </li>
                                                        <?php }?>
                                                        <?php if($this->main->has_perm('payment', 'payment.setup.delete.merchant')){?>    
                                                        <li>
                                                            <a ng-click="openDeleteDialog('merchant', $index, $event)">Delete</a>
                                                        </li>
                                                        <?php }?>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php }else{?>
                                <table class="table table-bordered table-condensed table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5">S/N</th>
                                            <th>Merchant Name</th>
                                            <th>Contact Person</th>
                                            <th>Phone No</th>
                                            <th>E-mail</th>
                                            <th width="5">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="6" style="text-align: center" >
                                                <div class="alert alert-danger">
                                                    <?= $this->lang->line('busary_access_denied')?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php }?>
                            </div>
                        </div>    
                    </div>
                    <div class="tab-pane" id="t8">
                        <div class="tab-content">                                                        
                            <div class="box-content">
                                <ul class="tabs pull-right form">
                                    <?php if($this->main->has_perm('payment', 'payment.setup.create.payhead')
                                            &&
                                            $this->main->has_perm('payment', 'payment.setup.view')){?>
                                    
                                        <li class="btn btn-lime" data-toggle="modal" href="#create_payhead_modal">
                                            <i class="icon-plus"> </i>
                                            Add Pay Head
                                        </li>
                                        
                                    <?php }?>
                                        
                                </ul><br/><br/>
                                <?php if($this->main->has_perm('payment', 'payment.setup.view') && $this->main->has_perm('payment', 'payment.setup.view.payexception')){?>
                                <table id="all_payhead" class="table table-bordered table-condensed table-hover table-striped  dataTable dataTables_paginate dataTables_filter">
                                    <thead>
                                        <tr>
                                            <th width="5">S/N</th>
                                            <th width="390">Pay Head Type</th>                                                                    
                                            <th width="5">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="payhead in data.payheads |  orderBy:'payheadid' ">
                                            <td ng-bind="$index + 1"></td>
                                            <td ng-bind="payhead.type"></td>                                                                    
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" data-toggle="dropdown" class="btn  btn-lime dropdown-toggle"><i class="icon-cog"> </i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a ng-click="openEditDialog('payhead', $index, $event)">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a ng-click="openDeleteDialog('payhead', $index, $event)">Delete</a>
                                                        </li>													
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table> 
                                <?php }else{?>
                                <table class="table table-bordered table-condensed table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5">S/N</th>
                                            <th width="390">Pay Head Type</th>                                                                    
                                            <th width="5">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="3" style="text-align: center" >
                                                <div class="alert alert-danger">
                                                    <?= $this->lang->line('busary_access_denied')?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php }?>
                            </div>
                        </div>                     
                    </div>
                    <div class="tab-pane" id="t9">                                            
                        <div class="box box-content">
                            <ul class="tabs pull-right form">
                                <?php if($this->main->has_perm('payment', 'payment.setup.create.payschedule')
                                        &&
                                            $this->main->has_perm('payment', 'payment.setup.view')){?>
                                
                                <li class="btn btn-lime" data-toggle="modal" href="#create_paysch_modal">
                                    <i class="icon-plus"> </i>
                                    Add Pay Schedule
                                </li>
                                
                                <?php }?>
                            </ul><br/><br/>
                            
                            <?php if($this->main->has_perm('payment', 'payment.setup.view') && $this->main->has_perm('payment', 'payment.setup.view.payschedule')){?>
                            
                            <table id="all_schedules" class="table table-bordered table-condensed table-hover table-striped  dataTable dataTables_paginate dataTables_filter">
                                <thead>
                                    <th>S/n</th>
                                    <th>Session Name</th>
                                    <th>Pay Head</th>
                                    <th>Instalment Type</th>
                                    <th>Amount</th>
                                    <th>Penalty</th>
                                    <th>Penalty Status</th>
                                    <th>Revenue Head</th>
                                    <th>Date Created</th>
                                    <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                    <tr ng-repeat=" schdl in data.payschedules">
                                        <td ng-bind="$index + 1"></td>
                                        <td ng-bind="schdl.sesname"></td>
                                        <td ng-bind="schdl.type"></td>
                                        <td ng-bind="schdl.percentage"></td>
                                        <td style="color: blue">NGN {{schdl.amount | number}}</td>
                                        <td style="color: brown">NGN {{schdl.penalty | number}}</td>
                                        <td style="text-align: center; color: orangered" ng-if="schdl.penalty_status == 'active'"> {{schdl.penalty_status}}</td>
                                        <td style="text-align: center; color: gray" ng-if="schdl.penalty_status == 'inactive'"> {{schdl.penalty_status}}</td>
                                        <td >{{schdl.revhead}}</td>
                                        <td >{{schdl.created}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" data-toggle="dropdown" class="btn  btn-lime dropdown-toggle"><i class="icon-cog"> </i> <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                       <a ng-click="openSetDialog('payschedule', $index, $event)" >Activate Penalty</a>
                                                    </li>
                                                    <li>
                                                        <a ng-click="openEditDialog('payschedule', $index, $event)" >Edit</a>
                                                    </li>
                                                    <li>
                                                        <a ng-click="openDeleteDialog('payschedule', $index, $event)" >Delete</a>
                                                    </li>													
                                                </ul>
                                            </div>
                                        </td> 
                                    </tr> 
                                </tbody>                                                        
                            </table>
                           <?php }else{?>
                                <table class="table table-bordered table-condensed table-striped">
                                    <thead>
                                        <th>S/n</th>
                                        <th>Session Name</th>
                                        <th>Pay Head</th>
                                        <th>Instalment Type</th>
                                        <th>Amount</th>
                                        <th>Penalty</th>
                                        <th>Payment Type</th>
                                        <th>Date Created</th>
                                        <th>&nbsp;</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="9" style="text-align: center">
                                                <div class="alert alert-danger">
                                                    <?= $this->lang->line('busary_access_denied')?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php }?>
                        </div>
                    </div>
                    <div class="tab-pane" id="t10">
                        
                        <div class="box box-content">                                                                                             
                            <ul class="tabs pull-right form">
                                <?php if($this->main->has_perm('payment', 'payment.setup.create.payinstalment')
                                        &&
                                        $this->main->has_perm('payment', 'payment.setup.view')
                                        && 
                                        $this->main->has_perm('payment', 'payment.setup.view.payinstalment')){?>
                                
                                <li class="btn btn-lime" data-toggle="modal" href="#create_instalment_modal">
                                    <i class="icon-plus"> </i>
                                    Add Instalment Percentage
                                </li>
                                
                                <?php }?>
                            </ul><br/><br/>
                            
                            <?php if($this->main->has_perm('payment', 'payment.setup.view') && $this->main->has_perm('payment', 'payment.setup.view.payinstalment')){?>
                            
                            <table id="all_instalment" class="table table-bordered table-condensed table-hover table-striped  dataTable dataTables_paginate dataTables_filter">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Unit</th>
                                        <th>Instalment % </th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr ng-repeat="inst in data.instalments">
                                        <td ng-bind="$index + 1"></td>
                                        <td ng-bind="inst.unit"></td>
                                        <td ng-bind="inst.percentage"></td>
                                        <td>                                                               
                                           <div class="btn-group">
                                                <a href="#" data-toggle="dropdown" class="btn  btn-lime dropdown-toggle"><i class="icon-cog"> </i> <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a ng-click="openEditDialog('instalment', $index, $event)">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a ng-click="openDeleteDialog('instalment', $index, $event)">Delete</a>
                                                    </li>													
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php }else{?>
                                <table class="table table-bordered table-condensed table-striped">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Unit</th>
                                            <th>Instalment % </th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="6" style="text-align: center" >
                                                <div class="alert alert-danger">
                                                    <?= $this->lang->line('busary_access_denied')?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    var merchants = <?php echo (is_array($merchant))? json_encode($merchant): '[]'?>;
    var payschedules = <?php echo (is_array($payschd))? json_encode($payschd): '[]'?>;
    var sessions = <?php echo (is_array($session))? json_encode($session): '[]'?>;
    var payheads = <?php echo (is_array($payhead))? json_encode($payhead): '[]'?>;
    var colleges = <?php echo (is_array($college))? json_encode($college): '[]'?>;
    var programmes = <?php echo (is_array($programmes))? json_encode($programmes): '[]'?>;
    var instalments = <?php echo (is_array($instalments))? json_encode($instalments): '[]'?>;
    var exceptions = <?php echo (is_array($exceptions))? json_encode($exceptions): '[]'?>;   
</script>