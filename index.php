<?php
include 'header.php';

$form_submission = isset($_POST['form_submission']) ? $_POST['form_submission'] : '';
if ($form_submission == 'yes') :
    $busName = isset($_POST['busname']) ? $_POST['busname'] : '';
    $busNumber = isset($_POST['busnumber']) ? $_POST['busnumber'] : '';
    $busCondition = isset($_POST['buscondition']) ? $_POST['buscondition'] : '';
    $busRoute = isset($_POST['busRoute']) ? $_POST['busRoute'] : '';
    $startTime = isset($_POST['startTime']) ? $_POST['startTime'] : '';
    $endTime = isset($_POST['endTime']) ? $_POST['endTime'] : '';
    $totalSeat = isset($_POST['totalSeat']) ? $_POST['totalSeat'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $busStatus = isset($_POST['status']) ? $_POST['status'] : '';

    eticket_add_bus($busName, $busNumber, $busCondition, $busRoute, $startTime, $endTime, $totalSeat, $date, $busStatus);


endif;

?>


    <div class="container-fluid">
        <div class="row">
            <?php include "sidebar.php"; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Buses List</h1>
                </div>
                <div class="">
                    <div class="row">
                        <div class="col-12">

                            <form action="">
                                <p>Date: <input class="form-control" type="text" id="datepicker"></p>
                            </form>

                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Bus Name</th>
                                        <th>Bus Number</th>
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
                                    <?php foreach (eticket_get_buses() as $bus) : $bus_id = eticket_get_var('id',$bus);
                                    ?>

                                    <tr>
                                        <?php echo eticket_get_buses_row($bus_id);?>

                                    </tr>
                                    <?php endforeach; ?>
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
                                                            <select class="form-select route" name="busRoute" id="busRoute">
                                                                <option value="">Select Route</option>
                                                                <option value="rangpur_to_dhaka">Rangpur-Dhaka</option>
                                                                <option value="dhaka_to_rangpur">Dhaka-Rangpur</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="busNumber" class="col-form-label">Bus Number</label>
                                                        <div class="">
                                                            <input type="text" name="busnumber" class="form-control" id="busNumber">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <label for="busCondition" class="col-form-label">Bus Condition</label>
                                                        <div class="">
                                                            <select class="form-select route" name="buscondition" id="busCondition">
                                                                <option value="">Select Condition</option>
                                                                <option value="ac">AC</option>
                                                                <option value="non_ac">Non AC</option>
                                                            </select>
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
                                                        <label for="datepicker" class="col-form-label">Date</label>
                                                        <div class="">
                                                            <input type="date" name="date" class="form-control" id="datepicker">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="busstatus" class="col-form-label">Status</label>
                                                        <select class="form-select status" name="status" id="busstatus">
                                                            <option value="">Select Status</option>
                                                            <option value="active">Active</option>
                                                            <option value="deactive">Deactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <input type="hidden" name="form_submission" class="id" value="yes">
                                                    <button type="submit" class="btn btn-primary">Save</button>
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