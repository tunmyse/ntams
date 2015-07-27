<style>
    .modal-help{
        width: 900px;
         margin-left: -500px;
    }
</style>
<!-- Create exam dialog -->
<div 
    class="modal hide fade modal-help" 
    id="utmeupload_help_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">UTME Upload Instruction</h4>
    </div> 
    <div class="modal-body">
        <h6>Step 1: Type UTME List in Excel with the format below </h6>
        <small>
        <table class="table table-condensed table-bordered">
            <thead>
                <tr>
                    <th>Reg. Id</th>
                    <th>first name</th>
                    <th>last name</th>
                    <th>middle name</th>
                    <th>phone</th>
                    <th>email</th>
                    <th>Subj1</th>
                    <th>Score1</th>
                    <th>Subj2</th>
                    <th>Score2</th>
                    <th>Subj3</th>
                    <th>Score3</th>
                    <th>Subj4</th>
                    <th>Score4</th>
                    <th>progid</th>
                    <th>Sex</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>12345as</td>
                    <td>Dayo</td>
                    <td>Tumishe</td>
                    <td>bada</td>
                    <td>080xxxx</td>
                    <td>a@t.com</td>
                    <td>1</td>
                    <td>50</td>
                    <td>2</td>
                    <td>80</td>
                    <td>3</td>
                    <td>48</td>
                    <td>4</td>
                    <td>67</td>
                    <td>12</td>
                    <td>Male</td>
                </tr>
            </tbody>
        </table>
        </small>
        <br/>
        <h6>Step 2: Choose Save As</h6>
        <img src="<?php echo site_url()?>img/upload_help/2save-as.jpg"/>
        <br/>
        <h6>Step 3: Specify File Name</h6>
        <img src="<?php echo site_url()?>img/upload_help/3file-name.jpg"/>
        <br/>
        <h6>Step 4: Save as CSV Comma Delimiter</h6>
        <img src="<?php echo site_url()?>img/upload_help/4csv-comma-delimited.jpg"/>
        <br/>
        <h6>Step 5: Save on Your Computer</h6>
        <img src="<?php echo site_url()?>img/upload_help/5final-save.jpg"/>
        <br/>
        <h6>Step 6: Open the TAMS Result Upload Page</h6>
        <img src="<?php echo site_url()?>img/upload_help/6upload-page.jpg"/>
        <br/>
        <h6>Step 7: Choose Result File to Upload Result</h6>
        <img src="<?php echo site_url()?>img/upload_help/7choose-file.jpg"/>
        <br/>
        <h6>Step 8: Specify Session, Course & click Upload</h6>
        <img src="<?php echo site_url()?>img/upload_help/8choose-course-to-upload.jpg"/>
    </div>   
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Ok</button>
    </div>
</div>