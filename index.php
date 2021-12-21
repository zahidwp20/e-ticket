<?php
include 'header.php';

$form_submission = isset($_POST['form_submission']) ? $_POST['form_submission'] : '';
$errors = array();
if($form_submission == 'yes') :
    $busName = isset($_POST['busname']) ? $_POST['busname'] : '';
    $busRoute = isset($_POST['busRoute']) ? $_POST['busRoute'] : '';
    $startTime = isset($_POST['startTime']) ? $_POST['startTime'] : '';
    $endTime = isset($_POST['endTime ']) ? $_POST['endTime '] : '';
    $totalSeat = isset($_POST['totalSeat']) ? $_POST['totalSeat'] : '';
    if(empty($busName)){
        $errors [] = "Empty or invalid bus name";
    }
    if(empty($busRoute)){
        $errors [] = "Empty or invalid bus route";
    }
    if(empty($startTime)){
        $errors [] = "Empty or invalid start time";
    }
    if(empty($endTime)){
        $errors [] = "Empty or invalid end time";
    }
    if(empty($totalSeat)){
        $errors [] = "Empty or invalid total seat";
    }

endif;

?>


    <div class="container-fluid">
        <div class="row">
            <?php include "sidebar.php";?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Buses List</h1>
                </div>
                <div class="">
                    <div class="row">
                        <div class="col-8">

                            <form action="">
                                <p>Date: <input class="form-control" type="text" id="datepicker"></p>
                            </form>

                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Bus Name</th>
                                        <th>Route</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Total Seats</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Green Line</td>
                                        <td>Route</td>
                                        <td>6:30 PM</td>
                                        <td>5:30 AM</td>
                                        <td>64</td>
                                        <td>Active</td>
                                        <td>20-12-2021</td>
                                        <td>
                                            <a href="ticket.php" class="btn btn-primary">Select Seat</a>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-primary">Delete</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>

                            <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add Bus
                            </a>
                            <!-- Button trigger modal -->


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
<!--                                            --><?php //if (count($errors) > 0): foreach ($errors as $error): ?>
<!--                                                <div class="alert alert-danger" role="alert">-->
<!--                                                    --><?php //echo $error; ?>
<!--                                                </div>-->
<!--                                            --><?php //endforeach; endif; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="busName" class="col-form-label">Bus Name</label>
                                                        <div class="">
                                                            <input type="text" name="busname" class="form-control" id="busName">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <label for="busRoute" class="col-form-label">Route</label>
                                                        <div class="">
                                                            <input type="text" name="busRoute" class="form-control" id="busRoute">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="startTime" class="col-form-label">Start Time</label>
                                                        <div class="">
                                                            <input type="text" name="startTime" class="form-control" id="startTime">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <label for="endTime" class="col-form-label">End Time</label>
                                                        <div class="">
                                                            <input type="text" name="endTime" class="form-control" id="endTime">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="totalSeat" class="col-form-label">Total Seat</label>
                                                        <div class="">
                                                            <input type="text" name="totalSeat" class="form-control" id="totalSeat">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <label for="status" class="col-form-label">Status</label>
                                                        <div class="">
                                                            <input type="text" name="status" class="form-control" id="status">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="datepicker" class="col-form-label">Date</label>
                                                        <div class="">
                                                            <input type="text" class="form-control" id="datepicker">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <input type="hidden" name="form_submission" class="id" value="yes">
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

<?php include 'footer.php'; ?>