


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
                        <li class="breadcrumb-item active">Wake Up List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <form method="POST" action="<?php echo base_url('wakeUpList');?>">
                <div class="container-fluid mt-2" style="background-color: #dee2e6;border-style: solid;border-width: 2px;border-color:#003d65;">
                    <center><h5>Apply Filter</h5></center>
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
                        
                        <div class="col-md-6 mt-3">
                            <button class="btn btn-primary" name="request" value="getData" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>

            <br><br>
                <a href="<?php echo base_url("wakeUpAdd");?>"><button class="btn btn-primary">Add</button></a> 
                <table class="table" id="languageTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Custom Name</th>
                            <th scope="col">Main Thumb</th>
                            <th scope="col">Name</th>
                            <th scope="col">Thumb</th>
                            <th scope="col">Video</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            <th scope="col">Delete</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($mainData) {
                        $counter = 1;
                        foreach ($mainData as $data) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $counter++;?></th>
                            <td><?php echo $data['main_custom_name'];?></td>
                            <td>
                                <img src="<?php echo base_url('uploads/thumb/').$data['main_thumb'];?>" alt="" height="50" width="50">
                            </td>
                           
                            <td>
                                <ul class="list-group">
                                    <li class="list-group-item"><?php echo $data['subOneName'];?></li>
                                    <li class="list-group-item"><?php echo $data['subTwoName'];?></li>
                                    <li class="list-group-item"><?php echo $data['subThreeName'];?></li>
                                </ul>
                            </td>
                            <td>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <img src="<?php echo base_url('uploads/thumb/').$data['thumb1'];?>" alt="" height="50" width="50">
                                    </li>
                                    <li class="list-group-item">
                                        <img src="<?php echo base_url('uploads/thumb/').$data['thumb2'];?>" alt="" height="50" width="50">
                                    </li>
                                    <li class="list-group-item">
                                        <img src="<?php echo base_url('uploads/thumb/').$data['thumb3'];?>" alt="" height="50" width="50">
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <a href="<?php echo base_url('uploads/video/').$data['sub1Url'];?>" target="_blank">Click To Watch</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="<?php echo base_url('uploads/video').$data['sub2Url'];?>" target="_blank">Click To Watch</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="<?php echo base_url('uploads/video/').$data['sub3Url'];?>" target="_blank">Click To Watch</a>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <?php echo (($data['is_active'] == 1)? "Enabled":"Disabled");?>
                            </td>
                            <td>
                                <a href="<?php echo base_url('editWakeUp').'?id='.$data['id'];?>"><button class="btn btn-primary">Edit</button></a>
                            </td>
                            <td>
                                <button class="btn btn-danger" onclick="opendeleteModal('<?php echo $data['id'];?>')">Delete</button>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                    ?>
                        <tr>
                            <th scope="row">1</th>
                            <td>No Data</td>
                            <td>No Data</td>
                            <td>No Data</td>
                            <td>No Data</td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
        </div>
    </section>
</div>




<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>




<script>
    $('#languageTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        title : 'Shubham'
    });

    function opendeleteModal(id) {
    // Display a confirmation dialog to the user
    var confirmDelete = confirm("Are you sure you want to delete this row?");
    if (confirmDelete) {
        // If the user confirms the deletion, send an AJAX request to the deleteRow method in the AdminController
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>AdminController/delete_wake_up_list_master",
            data: {id: id},
            success: function(response) {
                // Handle the response from the server if needed
                console.log(response);
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle any errors that occur during the AJAX request
                console.log("AJAX Error: " + textStatus + " - " + errorThrown);
            }
        });
    }
}
</script>