<div class="row-fluid">
    <ul class="thumbnails">
        <li class="span3">
            <a class="" href="#">
                <img class="img-polaroid" alt="360x270" src="<?php echo base_url("img/user/{$user_info->imageurl}")?>" 
                     style="width: 200px; height: 200px;"/>
            </a>
        </li>
        <li class="span9" style="min-height: 80px">
            <div class="page-header">
                <h1><?php echo strtoupper($user_info->lname)?>, <small><?php echo $user_info->fname?> 
                    <?php echo $user_info->mname?></small>
                </h1>
            </div>
        </li>         
        
        <li class="span9" style="min-height: 80px">
            <a class="btn btn-primary" data-toggle="modal" href="#change_image_modal">
                Change Photo
            </a>
            <a class="btn btn-primary" data-toggle="modal" href="#change_password_modal">
                Change Password
            </a>
            <a class="btn btn-primary" data-toggle="modal" href="#edit_profile_modal">
                Edit Profile
            </a>
        </li>
    </ul>
</div>

<div class="row-fluid">
    <fieldset>
        <legend>Personal Information</legend>
        <div class="span6">            
            <div>
                <p>
                    <span class="pull-left" style='width: 160px'>Sex:</span>
                    <span><?php echo ($user_info->sex)?></span>
                </p>
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Phone:</span>
                    <span><?php echo $user_info->phone?> 
                        <?php if($user_info->phonever != 'true') :?>
                        <span class="label label-important">Not verified</span>
                        <?php endif;?>
                    </span>
                </p>
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Email:</span>
                    <span class="text-right"><?php echo $user_info->email?> 
                        <?php if($user_info->emailver != 'true') :?>
                        <span class="label label-important">Not verified</span>
                        <?php endif;?>
                    </span>
                </p>
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Address:</span>
                    <span><?php echo $user_info->address? $user_info->address: 'N/A'?></span>
                </p>
            </div>
            <div class="clearfix">
                <span class="pull-left" style='width: 160px'>Date of Birth:</span>
                <span><?php echo $user_info->dob? $user_info->dob: 'N/A'?></span>
            </div>                  
        </div>
        
        <div class="span5">
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Nationality:</span>
                    <span><?php echo $user_info->nationality? $user_info->nationality: 'N/A'?></span>
                </p>            
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>State:</span>
                    <span> <?php echo $user_info->statename? $user_info->statename: 'N/A'?></span>
                </p>
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Local Government Area:</span>
                    <span><?php echo $user_info->lganame? $user_info->lganame: 'N/A'?></span>
                </p>
            </div>      
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Religion:</span>
                    <span><?php echo $user_info->religion? $user_info->religion: 'N/A'?></span>
                </p>
            </div>
            <div class="control-group">
                <p>
                    <span class="pull-left" style='width: 160px'>Marital Status:</span>
                    <span><?php echo $user_info->marital?></span>
                </p>
            </div>
        </div>   
    </fieldset>
</div>

<div class="row-fluid">
    <fieldset>
        <legend>Next of Kin/Sponsor's Information</legend>        
        <div class="span6">            
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Next of Kin Name:</span>
                    <span><?php echo $user_info->nklname.' '.$user_info->nkoname ?></span>
                </p>
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Next of Kin Relationship:</span>
                    <span> <?php echo $user_info->nkrelation? $user_info->nkrelation: 'N/A' ?></span>
                </p>
            </div> 
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Next of Kin Phone:</span>
                    <span><?php echo $user_info->nkphone? $user_info->nkphone: 'N/A' ?></span>
                </p>
            </div>            
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Next of Kin Email:</span>
                    <span><?php echo $user_info->nkemail? $user_info->nkemail: 'N/A' ?></span>
                </p>
            </div>      
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Next of Kin Address:</span>
                    <span><?php echo $user_info->nkaddress? $user_info->nkaddress: 'N/A' ?></span>
                </p>
            </div>
        </div>   
        <div class="span5">
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Sponsor's Name:</span>
                    <span><?php echo $acad_info->spname? $acad_info->spname: 'N/A'?></span>
                </p>
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Sponsor's Phone:</span>
                    <span><?php echo $acad_info->spphone? $acad_info->spphone: 'N/A'?></span>
                </p>
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Sponsor's Email:</span>
                    <span><?php echo $acad_info->spemail? $acad_info->spemail: 'N/A'?></span>
                </p>
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Sponsor's Address:</span>
                    <span><?php echo $acad_info->spaddress? $acad_info->spaddress: 'N/A'?></span>
                </p>
            </div>                 
        </div>
        
    </fieldset>
</div>

<div class="row-fluid">
    <fieldset>
        <legend>Academic Information</legend>
        <div class="span6">
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Student No.:</span>
                    <span><?php echo $user_info->usertypeid?></span>
                </p>
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Programme:</span>
                    <span><?php echo $acad_info->progname?></span>
                </p>
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Department:</span>
                    <span><?php echo $acad_info->deptname?></span>
                </p>
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>College:</span>
                    <span><?php echo $acad_info->colname?></span>
                </p>
            </div>                 
        </div>
        
        <div class="span5">
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Level:</span>
                    <span><?php echo $acad_info->level?></span>
                </p>
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Entry Year:</span>
                    <span><?php echo $acad_info->sesname?></span>
                </p>
            </div>
            <div class="clearfix">
                <p>
                    <span class="pull-left" style='width: 160px'>Admission Mode:</span>
                    <span><?php echo $acad_info->type?></span>
                </p>
            </div>  
        </div>
    </fieldset>
</div>