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
        <div class="span4">
            <div>
                <p>Sex: <span><?php echo $user_info->sex?></span></p>
            </div>
            <div>
                <p>Phone: <span><?php echo $user_info->phone?> 
                        <span class="label label-important">Not verified</span>
                            
                    </span>
                </p>
            </div>
            <div>
                <p>Email: <span class="text-right"><?php echo $user_info->email?> 
                        <span class="label label-important">Not verified</span></span>
                </p>
            </div>
            <div>
                <p>Address: <?php echo $user_info->sex?></p>
            </div>
            <div class="control-group">
                <label class="control-label" style="padding-top: 0">Date of Birth:</label>
                <div class="controls"><?php echo $user_info->dob?></div>
            </div>                  
        </div>
        
        <div class="span4">
            <div>
                <p>Nationality: Nigerian</p>
            </div>
            <div>
                <p>State: Ogun</p>
            </div>
            <div class="control-group">
                <p>Local Government Area: Obafemi-Owode</p>
            </div>      
            <div class="control-group">
                <p>Religion: Christianity</p>
            </div>
        </div>   
    </fieldset>
</div>

<div>
    <fieldset>
        <legend>Staff Information</legend>
        <div class="span4">
            <div>
                <p>Sex: <span><?php echo $user_info->sex?></span></p>
            </div>
            <div>
                <p>Phone: <span><?php echo $user_info->phone?> 
                        <span class="label label-important">Not verified</span>
                            
                    </span>
                </p>
            </div>
            <div>
                <p>Email: <span class="text-right"><?php echo $user_info->email?> 
                        <span class="label label-important">Not verified</span></span>
                </p>
            </div>
            <div>
                <p>Address: <?php echo $user_info->sex?></p>
            </div>
            <div class="control-group">
                <label class="control-label" style="padding-top: 0">Date of Birth:</label>
                <div class="controls"><?php echo $user_info->dob?></div>
            </div>                  
        </div>
        
    </fieldset>
</div>