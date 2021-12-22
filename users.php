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

            </main>

        </div>
    </div>

<?php


include 'footer.php';