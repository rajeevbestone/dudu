<?php
    if (isset($_SESSION['introVideosMgmt'])) {
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
        unset($_SESSION['introVideosMgmt']);        
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
                        <li class="breadcrumb-item active">Intro Videos Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Intro Video</button>
                </div>
            </div>
                <br><br>
                
                <table class="table" id="languageTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Link</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
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
                            <td>
                                <a href="<?php echo 'https://dialupdelta.com/uploads/video/'.$data['video_file_name'];?>" target="_blank"> Click To Play </a>
                            </td>
                            <td>
                                <?php echo (($data['is_active'] == 1)? 'Active':'Deactive');?>
                            </td>
                            <td>
                            <?php
                            if ($data['is_active'] == 1) {
                            ?>
                                <button class="btn btn-danger" onclick="deactive(<?php echo $data['id'];?>);">Deactive</button>
                            <?php
                            } else {
                            ?>
                                <button class="btn btn-success" onclick="active(<?php echo $data['id'];?>);">Active</button>
                            <?php
                            }
                            ?> 
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
        <h5 class="modal-title" id="exampleModalLabel">Add Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?php echo base_url('AdminController/addIntroVideo');?>" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="file" name="video" class="form-control" required>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
      </form>
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
    $('#languageTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        title : 'Shubham'
    });
</script>

<script>
    function deactive(id) {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>' + 'AdminController/deactiveInfoVideo',
                data: {
                    id: id,
                },
                dataType: "json",
                encode: true,
                // beforeSend: function(){
                //     $('#cover-spin').show(0);
                // },
            }).done(function(data) {
                // $('#cover-spin').hide();
                window.location.reload();
            }); 
    }

    function active(id) {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>' + 'AdminController/activeInfoVideo',
                data: {
                    id: id,
                },
                dataType: "json",
                encode: true,
                // beforeSend: function(){
                //     $('#cover-spin').show(0);
                // },
            }).done(function(data) {
                // $('#cover-spin').hide();
                window.location.reload();
            }); 
    }
</script>