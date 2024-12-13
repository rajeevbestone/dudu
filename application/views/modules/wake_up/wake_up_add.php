<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/sweetalert/dist/sweetalert.css">
<link href="<?php echo base_url(); ?>admintemplate/bower_components/jquery.filer/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>admintemplate/bower_components/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />

<!-- jquery file upload Frame work -->
<div id="cover-spin"></div>
<style>
    #cover-spin {
    position:fixed;
    width:100%;
    height: 100%;
    left:0px;right:0px;top:0px;bottom:0px;
    background-color: rgba(255,255,255,0.7);
    z-index:9999;
    display:none;
    
}

@-webkit-keyframes spin {
	from {-webkit-transform:rotate(0deg);}
	to {-webkit-transform:rotate(360deg);}
}

@keyframes spin {
	from {transform:rotate(0deg);}
	to {transform:rotate(360deg);}
}

#cover-spin::after {
    content:'';
    display:block;
    position:absolute;
    left:48%;top:40%;
    width:40px;height:40px;
    border-style:solid;
    border-color:black;
    border-top-color:transparent;
    border-width: 4px;
    border-radius:50%;
    -webkit-animation: spin .8s linear infinite;
    animation: spin .8s linear infinite;
}

</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
                        <li class="breadcrumb-item active">Wake Up Add</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
        <form method="post" enctype="multipart/form-data" id="form" action="<?php echo base_url('AdminController/uploadWakeUpVideo');?>">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="language" class="form-control" required>
                        <?php
                            foreach ($language as $ldata) {
                        ?>
                            <option value="<?php echo $ldata['id'];?>"><?php echo $ldata['language_name'].' - '.$ldata['slug']; ?></option>
                        <?php
                            } 
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                            <select name="gender" class="form-control" required>
                                <?php
                                    foreach ($gender as $gdata) {
                                ?>
                                    <option value="<?php echo $gdata['id']?>"><?php echo $gdata['name'];?></option>
                                <?php
                                    }
                                ?>
                            </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="program" class="form-control" required>
                        <?php
                            foreach ($program as $pdata) {
                        ?>
                            <option value="<?php echo $pdata['id']?>"><?php echo $pdata['program_name'];?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12">
                            
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Main Video Custom Name</label>
                                        <input type="text" name="main_custom_name" class="form-control" placeholder="Custom Name" required>
                                    </div>
                                    <div class="col-md-4">
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Main Thumb</label>
                                        <input type="file" name="main_thumb" class="form-control" required>
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <label for="addVideo">Sub 1 Name:</label>
                                        <input type="text" name="subOneName" placeholder="Name" required class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="addVideo">Sub 1 Thumb:</label>
                                        <input type="file" name="sub1thumbFile" placeholder="upload Video" required class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="addVideo">Sub 1 Video:</label>
                                        <input type="file" name="sub1videoFile" placeholder="upload Video" required class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="addVideo">Sub 2 Name:</label>
                                        <input type="text" name="subTwoName" placeholder="Name" required class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="addVideo">Sub 2 Thumb:</label>
                                        <input type="file" name="sub2thumbFile" placeholder="upload Video" required class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="addVideo">Sub 2 Video:</label>
                                        <input type="file" name="sub2videoFile" placeholder="upload Video" required class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="addVideo">Sub 3 Name:</label>
                                        <input type="text" name="subThreeName" placeholder="Name" required class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="addVideo">Sub 3 Thumb:</label>
                                        <input type="file" name="sub3thumbFile" placehzzzolder="upload Video" required class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="addVideo">Sub 3 Video:</label>
                                        <input type="file" name="sub3videoFile" placeholder="upload Video" required class="form-control" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button type="submit" name="request" value="addWakeUpVideos" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </section>
</div>


<script>
   
</script>