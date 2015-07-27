<div class="span12">
    <div class="box box-bordered box-color">
        <div class="box-title">
            <h3><i class="icon-credit-card"></i> Make Payment </h3>
        </div>
        <div class="box-content">
            <?php //var_dump($my_paying)
            if($schedule['penalty_status'] == 'active'){?>
                <div class="alert alert-block alert-warning">
                    <i class=" icon-warning-sign" style="font-size: 35px"></i>
                    <strong>Sorry! </strong> Late payment Penalty Fee of <strong>NGN <?= number_format($schedule['penalty'], 2)?> </strong> Has been Activated on this pay Schedule 
                      See Details bellow and Proceed with your payment.
                </div>
            <?php }?>
            <table class="table table-bordered table-condensed table-hover table-striped" width="690">
                <thead>
                    <tr>
                        <th width="300">Payment Description</th>
                        <th width="100" >Actual Amount</th>
                        <th width="100" >Penalty</th>
                        <th width="100">Installment Option(s) </th>
                        <th width="90">&nbsp; </th>
                    </tr>
                </thead>
                <tbody>
                    <form method="post" action="<?php echo base_url('bursary/invoice')?>">
                        <tr >
                            <td><strong><?= ucwords($schedule['sesname'] .' '. $schedule['type']) ?></strong></td>
                            <td style="color: blue"><?= 'NGN '. number_format(($schedule['amount']), 2);?></td>
                            <td style="color: red"><?= ($schedule['penalty_status'] == 'active') ? 'NGN '. number_format($schedule['penalty'], 2) : 'NGN 0.00';?></td>
                            <td>
                                <select  name="percentage" class=" input-mini chosen-select" >
                                    <?php   
                                    if($schedule['penalty_status'] == 'inactive'){
                                        if($total_percent_paid < 1){ ?>
                                            <option value="100">100</option>
                                  <?php }
                                  
                                    foreach($percentage as $val){ ?>
                                            
                                        <option value="<?= $val?>"> <?= $val?></option>
                                        
                                    <?php } 
                                    
                                    }else{?>
                                            <option value="<?= $penalty_percentage ?> "> <?= $penalty_percentage ?></option>
                                     <?php }?>        
                                </select>
                            </td>
                            <!--<input type="hidden" name="schoolid" value="<?php //echo $my_paying['school_id']?>">-->
                            <input type="hidden" name="scheduleid" value="<?php echo $schedule['scheduleid']?>">
                            <input type="hidden" name="scheduletype" value="<?php echo $schedule['type']?>">
                            <input type="hidden" name="sessionname" value="<?php echo $schedule['sesname']?>">
                            <input type="hidden" name="sessionid" value="<?php echo $schedule['sesid']?>">
                            <input type="hidden" name="amount" value="<?php echo $schedule['amount']?>">
                            <input type="hidden" name="penalty_status" value="<?php echo $schedule['penalty_status']?>">
                            <input type="hidden" name="penalty" value="<?php echo $schedule['penalty']?>">
                            <input type="hidden" name="revenue_head" value="<?php echo $schedule['revhead']?>">
                            <input type="hidden" name="payid" value="<?php echo $schedule['payid']?>">
                            <td style="text-align: center"><button class="btn btn-file btn-magenta" type="submit"><i class="icon-shopping-cart"></i> Get Invoice</button></td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
    </div>
</div>