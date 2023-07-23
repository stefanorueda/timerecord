<?php $this->load->view('layouts/header.php'); ?>

<section class="container my-5">
    <button type="button" class="btn btn-primary my-5" data-bs-toggle="modal" data-bs-target="#usersModal">
        + Add Users
    </button>


    <table class="table table-hover my-5" id="userstable">
        <thead>
            <tr class="table-primary">
                <th scope="col">ID</th>
                <th scope="col">username</th>
                <th scope="col">type</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $x = 1;
            foreach ($users as $key) {

                ?>
                <tr>
                    <th scope="row"><?= $key->id ?></th>
                    <td><?= $key->user_name ?></td>
                    <td><?= $key->user_type ?></td>
                    <td></td>
                    <!-- <td>
          <a href="<?php echo base_url() . "employees/view_timesheets/" . $key->id ?>" class="btn btn-success"> View Timesheets</a>
            <a href="#edit_modal" data-toggle="modal" class="btn btn-warning update_employee_btn"
            data-id="<?= $key->id ?>" data-lname="<?= $key->last_name ?>" data-fname="<?= $key->first_name ?>"> Update</a>
            <a href="<?php echo base_url() ?>employees/delete_employee/<?php echo $key->id ?>" class="btn btn-danger"  onclick="return confirm('Do you want to delete this employee?');"> Delete</a>
          </td> -->
                </tr>
            <?php } ?>

        </tbody>
    </table>




    <!-- Add Modal -->
    <div class="modal fade" id="usersModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Users</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add_employee_form">
                    <div class="modal-body">
                        <fieldset>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label mt-4"><b>username</b></label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="form-label mt-4"><b>password</b></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="form-label mt-4"><b>confirm password</b></label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                            </div>
                        </fieldset>
                        <div class="modal-footer">
                            <button type="submit" id="add_users" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</section>


<script type="text/javascript">
    $('#userstable').DataTable();


    $("#add_users").click(function(e) {
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();
        // $('#employeeModal').modal('hide')
        $.ajax({
            url: "<?php echo base_url('Users/add_users'); ?>",
            method: "POST",
            data: {
                username: username,
                password: password,
                confirm_password: confirm_password,
            },
            success: function(data) {
                if (data === "success") {
                    Swal.fire({
                        text: "User successfully added!",
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    })
                } else {
                    Swal.fire(data)
                }


            },
            error: function() {
                alert("Please enter valid fields");
            }
        });
    });
</script>

<?php $this->load->view('layouts/footer.php'); ?>