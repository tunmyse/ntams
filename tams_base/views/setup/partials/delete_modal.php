<!-- Delete modal dialog -->
<div 
    class="modal hide fade" 
    id="delete_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Delete <?php echo $type?></h4>
    </div>
    
    <form 
        id="delete_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url("setup/{$type}/delete")?>">
        
        <div class="modal-body">
            <p>Are you sure you want to delete the <?php echo $type?> "{{current.name}}"</p>
        </div>
        
        <input type="hidden" name="delete_id" value="{{current.id}}"/>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="delete_button">Delete</button>
        </div>
    </form>
</div>