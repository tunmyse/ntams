<div class="row-fluid">
        <div class="span12">
                <div class="box box-bordered box-color">
                        <div class="box-title">
                                <h3><i class="glyphicon-credit_card"></i><i class="glyphicon-ok_2"></i> Transaction Successfull</h3>
                        </div>
                        <div class="box-content">
                                <div class="form-horizontal form-bordered">
                                        <div class="control-group">
                                                <label class="control-label" for="fullname"> Full Name </label>
                                                <div class="controls">
                                                        <?php echo $result['can_name']?>
                                                </div>
                                        </div>
                                        <div class="control-group">
                                                <label class="control-label" for="can_no">
                                                    <?php   
                                                            if($result['usertype'] == 'student'){
                                                                $label = 'Matric No.';
                                                            }elseif($result['usertype'] == 'prospective'){
                                                                $label = 'Registration No.';   
                                                            }else{
                                                               $label = 'Staff ID'; 
                                                            }
                                                            echo $label;
                                                    ?>
                                                   
                                                </label>
                                                
                                                <div class="controls">
                                                        <?php echo $result['usertypeid']?>
                                                </div>
                                        </div>
                                        <div class="control-group">
                                                <label class="control-label" for="password">Payment Description.</label>
                                                <div class="controls">
                                                        <?php echo $result['pay_desc']?>    
                                                </div>
                                        </div>
                                        <div class="control-group">
                                                <label class="control-label" for="textarea">Response Description. </label>
                                                <div class="controls" style="color: green">
                                                        <?php echo $result['resp_desc']?>
                                                </div>
                                        </div>
                                        <div class="control-group">
                                                <label class="control-label" for="textarea">Transaction Reference. </label>
                                                <div class="controls">
                                                        <?php echo $result['reference']?>
                                        </div>
                                        <div class="control-group">
                                                <label class="control-label" for="textarea">Date & Time . </label>
                                                <div class="controls">
                                                        <?php echo $result['date_time']?>
                                                </div>
                                        </div>
                                        <div class="control-group">
                                               <label class="control-label" for="amount">Amount  </label>
                                               <div class="controls">
                                                       <?php echo $result['amt']?>
                                               </div>
                                        </div>
                                        <div class="control-group">
                                               <label class="control-label" for="amount">Amount in Words</label>
                                               <div class="controls">
                                                       <?php echo $result['amount2word']?>
                                               </div>
                                        </div>
                                    <p style="text-align: center; font-size: 16px" class="alert alert-success">
                                        <i style="font-size: 20px" class="glyphicon-warning_sign"></i>
                                              Kindly note your Transaction Reference number as it will be used to track dispute.
                                            A copy of this receipt has been sent to the email address you provided.
                                        </p>
                                        <div class="form-actions">
                                                <button class="btn btn-lightgrey" type="submit"><i class="glyphicon-print"></i> Print Receipt</button>
                                                <button class="btn" type="button">Cancel</button>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>