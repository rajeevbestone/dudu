<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Feedback</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">

            <table class="table" id="languageTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Age</th>
                        <th scope="col">Sex</th>
                        <th scope="col">Program 1</th>
                        <th scope="col">Duration 1</th>
                        <th scope="col">+/- Minutes From Default 1</th>
                        <th scope="col">+/- Program 2</th>
                        <th scope="col">+/- Duration 2</th>
                        <th scope="col">+/- Minutes From Default 2</th>
                        <th scope="col">Hours Slept</th>
                        <th scope="col">Day</th>
                        <th scope="col">Status</th>
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
                                <th scope="row"><?php echo $counter++; ?></th>
                                <td><?php echo $data["age"];?></td>
                                <td><?php echo $data["sex"];?></td>
                                <td><?php echo $data["program_1"];?></td>
                                <td><?php echo $data["duration_1"];?></td>
                                <td><?php echo $data["minutes_from_default_1"];?></td>
                                <td><?php echo $data["program_2"];?></td>
                                <td><?php echo $data["duration_2"];?></td>
                                <td><?php echo $data["minutes_from_default_2"];?></td>
                                <td><?php echo $data["hours_slept"];?></td>
                                <td><?php echo ucfirst($data["day"]) ;?></td>
                                <td><?php echo (($data["is_active"]==1)? "Active":"In Active");?></td>
                            <td> <button class="btn btn-danger" onclick="opendeleteModal('<?php echo $data['id'];?>')">Delete</button> </td>

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
                            <td>No Data</td>
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


<script>

</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    $('#languageTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        title: 'Shubham'
    });
</script>

<script>
    <?php $counter = 1;
    foreach ($mainData as $data) : ?>
        var ctx = document.getElementById('lineChart-<?= $counter++; ?>').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["10PM", "11PM", "12PM", "1AM", "2AM", "3AM", "4AM", "5AM", "6AM"],
                datasets: [{
                    label: 'Sleep Pattern',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: <?= json_encode(explode(",", $data['pattern'])); ?>
                }]
            }
        });
    <?php endforeach; ?>


    function opendeleteModal(id) {
    // Display a confirmation dialog to the user
    var confirmDelete = confirm("Are you sure you want to delete this row?");
    if (confirmDelete) {
        // If the user confirms the deletion, send an AJAX request to the deleteRow method in the AdminController
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>AdminController/delete_feedback_master",
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