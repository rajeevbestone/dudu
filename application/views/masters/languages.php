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
                        <li class="breadcrumb-item active">Languages</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <form method="POST" action="<?php echo base_url('AdminController/insertMasters_language');?>">
                <div class="container-fluid mt-2" style="background-color: #dee2e6;border-style: solid;border-width: 2px;border-color:#003d65;">
                    <center><h5>Add Language</h5></center>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Language Name</label>
                            <input name="language_name" type="text" placeholder="Language Name - English" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Language Slug</label>
                            <input name="slug" type="text" placeholder="Language Slug - en" class="form-control" required>
                        </div>
                        <input type="hidden" name="route" value="languages">
                        <input type="hidden" name="table_name" value="language_master">
                        <div class="col-md-6 mt-3">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>

            <br><br>

                <table class="table" id="languageTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
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
                            <td><?php echo $data['language_name'];?></td>
                            <td><?php echo $data['slug'];?></td>
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
            url: "<?php echo base_url();?>AdminController/deletelanguages_master",
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