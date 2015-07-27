<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Payment  
 * 
 * @category   View
 * @package    Busary
 * @subpackage paylib/pay
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
                <i class="icon-money"></i> Payment 
            </h3>    
        </div>
        <div class="box-content">
            <form method="post" action="<?php echo site_url('paylib/process')?>">
                <table class="table table-condensed table-striped table-bordered table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>Schedule id</th>
                            <th>Payment Description </th>
                            <th>Amount NGN </th>
                            <th>Percentage</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($rs['scheduleid']) && isset($rs['amount']) && isset($rs['sesid'])){?>
                        <tr>
                            <td><?= $rs['scheduleid'] ?></td>
                            <td><?= $rs['description'] ?> </td>
                            <td><?= $rs['amount']; ?></td>
                            <td><?= $rs['percentage']; ?></td>
                            <td>
                                <a href="<?=  $this->agent->referrer()?>" class="btn "> Cancel</a>
                                <button class="btn btn-primary" type="submit"> Pay Now</button>
                            </td>
                        </tr>
                        <?php }else{?>
                        <tr>
                            <td colspan="5" style="text-align: center; color: red">
                                The payment Engine could not find the required parameters to process request Click Cancel to go Back<br/>
                                <a href="<?=  $this->agent->referrer()?>" class="btn "> Cancel</a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                    <input type="hidden" name="scheduleid" value="<?= $rs['scheduleid']; ?>">
                    <input type="hidden" name="userid" value="<?= $rs['userid']; ?>">
                    <input type="hidden" name="amount" value="<?= $rs['amount']; ?>">
                    <input type="hidden" name="percentage" value="<?= $rs['percentage']; ?>">
                    <input type="hidden" name="description" value="<?= $rs['description']; ?>">
                    <input type="hidden" name="schoolid" value="<?= $rs['schoolid']; ?>">
                    <input type="hidden" name="sesid" value="<?= $rs['sesid']; ?>">
                    <input type="hidden" name="penalty" value="<?= (isset($rs['penalty']))? $rs['penalty'] : ''?>">
                    <input type="hidden" name="revhead" value="<?= $rs['revhead'] ?>">
                </table> 
            </form>
        </div>
    </div>
</div>

