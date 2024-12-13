<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

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
                        <li class="breadcrumb-item active">Users Feed</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Feeds</h3>
                </div>
                <div class="card-body">
                <?php
                    if ($main && $sleepEnhancerPrograms) {
                        $mainCounter = 1;
                        foreach ($main as $mainData) {
                ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Gender - <b><?php echo $mainData["genderName"];?></b></h3>
                        </div>
                        <div class="card-body">
                            <table class="table" id="usersFeed<?php echo $mainCounter;?>">
                                <thead>
                                    <th>Age Group</th>
                                <?php
                                    if ($sleepEnhancerPrograms) {
                                        foreach ($sleepEnhancerPrograms as $sPrograms) {
                                ?>
                                    <th><?php echo $sPrograms["program_name"]." (A)";?></th>
                                <?php
                                        }
                                    }
                                ?>
                                <?php
                                    if ($sleepEnhancerPrograms) {
                                        foreach ($sleepEnhancerPrograms as $sPrograms) {
                                ?>
                                    <th><?php echo $sPrograms["program_name"]." (B)";?></th>
                                <?php
                                        }
                                    }
                                ?>
                                </thead>
                                <tbody>
                                <?php
                                    if ($mainData["ageWiseData"]) {
                                        foreach ($mainData["ageWiseData"] as $ageValues) {
                                ?>
                                    <tr>
                                        <td><?php echo $ageValues["ageRange"];?></td>
                                <?php
                                            if ($ageValues["programData"]["A"]) {
                                                foreach ($ageValues["programData"]["A"] as $programValuesA) {
                                ?>
                                        <td style="color:<?php echo $programValuesA["color"];?>"><?php echo $programValuesA["percentage"];?></td>
                                <?php
                                                }
                                            }
                                ?>
                                
                                
                                <?php
                                            if ($ageValues["programData"]["B"]) {
                                                foreach ($ageValues["programData"]["B"] as $programValuesB) {
                                ?>
                                        <td style="color:<?php echo $programValuesB["color"];?>"><?php echo $programValuesB["percentage"];?></td>
                                <?php
                                                }
                                            }
                                ?>
                                
                                    </tr>
                                <?php
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <script>
                        $('#usersFeed<?php echo $mainCounter;?>').DataTable( {
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        });
                    </script>
                    
                <?php
                            $mainCounter++;
                        }
                    }
                ?>
                    <br>
                    
                </div>
            </div>
            
        </div>
    </section>
</div>



