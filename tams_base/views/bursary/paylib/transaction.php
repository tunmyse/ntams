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

?>
<div class="span12">
    <div class="box box-bordered box-color">
        <div class="box-title">
            <h3>
                <i class="icon-money"></i> Payment 
            </h3>    
        </div>
        <div class="box-content">
            <div class="alert <?= ($message['flag'] == 1)? 'alert-success' : 'alert-warning'?>">
                <?= (!empty($message))? $message['msg'] : ''?>
            </div>
        </div>
    </div>
</div>

