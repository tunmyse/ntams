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
                        <?php if($user_info->phonever != 'true')  :?>
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

<div>
    <fieldset>
        <legend>Admin Information</legend>
       
        
    </fieldset>
</div>