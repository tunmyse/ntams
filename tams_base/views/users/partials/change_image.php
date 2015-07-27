<!-- Change image dialog -->
<div 
    class="modal hide fade" 
    id="change_image_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Change Profile Photo</h4>
    </div>
    
    <form 
        id="change_image_form" 
        class="form-horizontal form-validate" 
        method="post" 
        action="<?php echo site_url("{$user_type}/profile/edit/change_image")?>" 
        enctype="multipart/form-data">
                
        <div class="modal-body">    
            <div data-provides="fileupload" class="fileupload fileupload-new">
                <div style="width: 150px; height: 150px;" class="fileupload-new thumbnail">
                    <img src="<?php echo base_url("img/user/$user_info->imageurl")?>"/>
                </div>
                <div style="max-width: 150px; max-height: 150px; line-height: 20px;" 
                    class="fileupload-preview fileupload-exists thumbnail">  
                </div>
                <div>
                    <span class="btn btn-file">
                        <span class="fileupload-new">Select Photo</span>
                        <span class="fileupload-exists">Change Selection</span>
                        <input type="file" name="imagefile" data-rule-required="true">
                    </span>
                    <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove Photo</a>
                </div>
            </div>      
        </div>
        
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="change_image_button">Upload Photo</button>
        </div>
    </form>
</div>