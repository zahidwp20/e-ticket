<?php

include 'header.php';


?>


    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Users</h1>
                </div>

                <table class="table table-striped table-hover table-users">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email Address</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach (eticket_get_users() as $user) : $user_id = eticket_get_var('id', $user); ?>

                        <tr data-user-id="<?php echo $user_id; ?>">
                            <?php echo eticket_get_user_row($user_id); ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Edit User Modal Window -->
                <div class="modal fade" id="showViewWindow" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">View User Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="user-info-wrap">
                                    <div class="info-item">
                                        <h4 class="info-label">User Name</h4>
                                        <div class="info user_name"></div>
                                    </div>
                                    <div class="info-item">
                                        <h4 class="info-label">First Name</h4>
                                        <div class="info first_name"></div>
                                    </div>
                                    <div class="info-item">
                                        <h4 class="info-label">Last Name</h4>
                                        <div class="info last_name"></div>
                                    </div>
                                    <div class="info-item">
                                        <h4 class="info-label">Email Address</h4>
                                        <div class="info email_address"></div>
                                    </div>
                                    <div class="info-item">
                                        <h4 class="info-label">Phone Number</h4>
                                        <div class="info phone_number"></div>
                                    </div>
                                    <div class="info-item">
                                        <h4 class="info-label">Date of Birth</h4>
                                        <div class="info designation"></div>
                                    </div>
                                    <div class="info-item">
                                        <h4 class="info-label">Status</h4>
                                        <div class="info designation"></div>
                                    </div>
                                    <div class="info-item">
                                        <h4 class="info-label">Gender</h4>
                                        <div class="info designation"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

        </div>
    </div>

<?php


include 'footer.php';