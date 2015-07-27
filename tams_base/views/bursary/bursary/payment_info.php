<div class="row-fluid">
    <div class="span12">
        <div class="box box-color">
            <div class="box-title">
                <h3>
                        <i class="icon-money"></i>
                        Payment Information
                </h3>                                    
            </div>
            <div class="box-content nopadding">
                <form action="#" method="POST" class='form-horizontal form-striped'>
                        <div class="control-group">
                                <label class="control-label">Name</label>
                                <div class="controls">
                                            <span class="input-xlarge uneditable-input">name</span>
                                </div>
                        </div>
                        <div class="control-group">
                                <label for="numberfield" class="control-label">Matric number</label>
                                <div class="controls">
                                        <span class="input-xlarge uneditable-input">matric number</span>
                                </div>
                        </div>
                        <div class="control-group">
                                <label for="text" class="control-label">Program</label>
                                <div class="controls">
                                        <span class="input-xlarge uneditable-input">program</span>
                                </div>
                        </div>                                            
                        <div class="control-group">
                                <label for="textarea" class="control-label">Info: You are about to pay the following amount</label>
                                <div class="controls">
                                    <div class="input-append input-prepend">                                                                
                                            <span class="add-on">#</span>
                                            <span class="input-medium uneditable-input">amount due</span>
                                            <span class="add-on">.00</span>
                                    </div>                                                                                                               
                                    <div class="input-append input-prepend">
                                            <span class="add-on">#</span>                                                                                                                              
                                            <span class="input-medium uneditable-input">amount payable</span>
                                            <div class="btn-group">
                                                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                                                            rate
                                                            <span class="caret"></span>
                                                    </button>                                                                         
                                                    <ul class="dropdown-menu">
                                                            <li>
                                                                    <a href="#">Full</a>
                                                            </li>
                                                            <li>
                                                                    <a href="#">60%</a>
                                                            </li>
                                                            <li>
                                                                    <a href="#">40%</a>
                                                            </li>
                                                    </ul>
                                            </div>
                                    </div>                                                        
                                </div>                                                 
                        </div>                                          
                        <div class="control-group">
                                <label class="control-label">Card type</label>
                                <div class="controls">
                                        <label class='radio inline'>
                                            <input type="radio" name="checkbox"><img src="img/demo/mastercard.png">                                                              
                                        </label>
                                        <label class='radio inline'>
                                                <input type="radio" name="checkbox"><img src="img/demo/visa.png">
                                        </label>
                                        <label class='radio inline'>
                                                <input type="radio" name="checkbox"><img src="img/demo/paypal.png">
                                        </label>                                                            
                                </div>
                        </div>
                        <div class="form-actions">
                                <li class="btn btn-lime" data-toggle="modal" href="#create_college_modal"> Pay Now</li>
                                <button type="button" class="btn">Cancel</button>
                        </div>
                        <!--college modal-->
                        <div 
                            class="modal hide fade" 
                            id="create_college_modal" 
                            tabindex="-1" role="dialog" 
                            aria-labelledby="basicModal" 
                            aria-hidden="true">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                <h4 class="modal-title" id="myModalLabel">Confirm Payment</h4>
                            </div>                                                
                            <div class="modal-body">
                                <div class="box-content">
                                     You are about to make a transaction. Do you wish to proceed?
                                </div>                                                                                                                                
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
                                <button class="btn btn-primary" type="submit" id="create_college_button">Proceed</button>
                            </div>                                          
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>