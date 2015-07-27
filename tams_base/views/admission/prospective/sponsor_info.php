<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Prospective Registartion form 2 
 * 
 * @category   View
 * @package    Admission
 * @subpackage Prospective registaration
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

//var_dump($exam_grade['rs']);
?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Application Form - 6 of 8</h3>
                
            </div>
            <div class="box-content">
                 <h4 class="span"><i class="glyphicon-parents"></i> Next of Kin / Sponsor's Details </h4>
                <form class="form-horizontal form-column form-bordered" 
                    method="POST" 
                    action="<?php echo site_url('admission/submit/sponsor')?>">
                   
                    <div class="row-fluid">
                        <div class=" span12row">
                           <div class="span6">
                            <table class="table table-condensed table-striped table-bordered table-colored-header">
                                <thead>
                                    <tr>
                                        <th colspan="2">Next of Kin Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td  widtd="40%">Next of Kin Surname : </td>
                                        <td>
                                            <input type="text" class="input-large " id="nkfname" name="nkfname"  required="required">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Next of Kin Otder names : </td>
                                        <td>
                                            <input type="text" class="input-large " id="nkoanme" name="nkoanme"  required="required">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Next of Kin Phone : </td>
                                        <td>
                                            <input type="text" class="input-large " id="nkphone" name="nkphone" required="required">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Next of Kin E-mail : </td>
                                        <td>
                                            <input type="email" class="input-large  " id="nkphone" name="nkmail" required="required">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Next of Kin Contact Address : </td>
                                        <td>
                                            <textarea class="input-large" name="nkaddress" rows="3"  required="required"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Relationship : </td>
                                        <td>
                                            <input type="text" class="input-large  " id="nkphone" name="relationship"  required="required">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="span6">
                            <table class="table table-condensed table-striped table-bordered table-colored-header">
                                <thead >
                                    <tr>
                                        <th colspan="2">Sponsor's Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td widtd="30%">Sponsor's Full Name: </td>
                                        <td>
                                            <input type="text" class="input-large " id="sp_flname" name="sp_flname" required="required">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sponsor's phone : </td>
                                        <td>
                                            <input type="text" class="input-large " id="sp_phone" name="sp_phone"  required="required">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sponsor's E-mail : </td>
                                        <td>
                                            <input type="email" class="input-large " id="sp_phone" name="sp_mail"  required="required">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sponsor's Address: </td>
                                        <td>
                                            <textarea class="input-large" name="sp_address" rows="3"  required="required"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>  
                        </div>
                         
                    </div>
                    <input type="hidden" name="formnum" value="7">
                    <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Save changes</button>
                            <button class="btn" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
