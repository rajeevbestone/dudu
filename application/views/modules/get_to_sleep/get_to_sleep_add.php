


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
                        <li class="breadcrumb-item active">Add Get To Sleep</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('AdminController/getToSleep_add');?>">
                <div class="container-fluid mt-2" style="background-color: #dee2e6;border-style: solid;border-width: 2px;border-color:#003d65;">
                    <center><h5>Add Get To Sleep</h5></center>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Language</label>
                            <select name="language" id="" class="form-control">
                            <?php
                            foreach ($language as $lanData) {
                            ?>    
                                <option value="<?php echo $lanData['id'];?>"><?php echo $lanData['language_name'].' '.$lanData['slug'];?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="">Program</label>
                            <select name="program" id="" class="form-control">
                            <?php
                            foreach ($program as $pgrData) {
                            ?>
                                <option value="<?php echo $pgrData['id'];?>"><?php echo $pgrData['program_name'];?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="">Duration</label>
                            <select name="duration" id="" class="form-control">
                                <option value="5">5 Mins</option>
                                <!--<option value="9">9 Mins</option>-->
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="">Gender</label>
                            <select name="gender" id="" class="form-control">
                            <?php
                            foreach ($gender as $genderData) {
                            ?>
                                <option value="<?php echo $genderData['id'];?>"><?php echo $genderData['name'];?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="">Custom File Name</label>
                            <input type="text" name="custom_file_name" id="custom_file_name" class="form-control" required placeholder="Custom File Name">
                        </div>
                        <div class="col-md-12">
                            <label for="">Add Thumb</label>
                            <input type="file" name="thumb" required>
                        </div>
                        <div class="col-md-12">
                            <label for="">Add MP3</label>
                            <input type="file" name="video" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <button class="btn btn-primary" name="request" value="addData" type="submit">Submit</button>
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