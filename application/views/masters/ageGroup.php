<?php
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
                        <li class="breadcrumb-item active">Age Group</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <form method="POST" action="<?php echo base_url('AdminController/insertMasters_ageGroup');?>">
                <div class="container-fluid mt-2" style="background-color: #dee2e6;border-style: solid;border-width: 2px;border-color:#003d65;">
                    <center><h5>Add Age Group</h5></center>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Min Range</label>
                            <input name="min_range" type="number" min="0" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Max Range</label>
                            <input name="max_range" type="number" min="0" class="form-control" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>

            <br><br>

                <table class="table" id="ageGroupTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Age Group</th>
                            <th scope="col">Min Range</th>
                            <th scope="col">Max Range</th>
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
                            <td><?php echo $data["age_group_name"];?></td>
                            <td><?php echo $data["min_range"];?></td>
                            <td><?php echo $data["max_range"];?></td>
                            <td><?php echo (($data['is_active'] == 1)? 'Active':'Inactive');?></td>
                            <td><button class="btn btn-primary" onclick="openEditModal('<?php echo $data['id'];?>')">Edit</button></td>
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


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Age Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?php echo base_url('AdminController/editAgeGroup');?>" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <input type="number" id="min_range" class="form-control" name="min_range" min="0" required>
            </div>
            <div class="col-md-6">
                <input type="number" id="max_range" name="max_range" class="form-control" min="0" required>
            </div>
            <input type="hidden" name="ageGroup_id" id="ageGroup_id" required>
        </div>
      </div>
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
    

    $('#ageGroupTable').DataTable( {
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
    
    function openEditModal(id) {
        // Display a confirmation dialog to the user
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>"+"AdminController/getAgeGroup_data",
            data: {
                id: id
            },
            dataType: "json",
            encode: true
        }).done(function(response) {
            $("#ageGroup_id").val(response.data[0].id);
            $("#min_range").val(response.data[0].min_range);
            $("#max_range").val(response.data[0].max_range);
            $('#editModal').modal('show');
        });
    }
    
</script>