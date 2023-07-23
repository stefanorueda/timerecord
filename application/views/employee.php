<?php $this->load->view('layouts/header.php'); ?>



<section class="container my-5">
  <button type="button" class="btn btn-primary my-5" data-bs-toggle="modal" data-bs-target="#employeeModal">
    + Add Employee
  </button>


  <table class="table table-hover my-5" id="employeetable">
    <thead>
      <tr class="table-primary">
        <th scope="col">ID</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">QR code</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $x = 1;
      foreach ($employees as $key) {

        ?>
        <tr>
          <th scope="row"><?= $key->id ?></th>
          <td><?= $key->first_name ?></td>
          <td><?= $key->last_name ?></td>
          <td>
            <img src="<?php echo base_url() . $key->file ?>" alt="s" width="100" height="100">
          </td>
          <td>
          <a href="<?php echo base_url()."employees/view_timesheets/".$key->id?>" class="btn btn-success"> View Timesheets</a>
            <a href="#edit_modal" data-toggle="modal" class="btn btn-warning update_employee_btn"
            data-id="<?= $key->id ?>" data-lname="<?= $key->last_name ?>" data-fname="<?= $key->first_name ?>"> Update</a>
            <a href="<?php echo base_url()?>employees/delete_employee/<?php echo $key->id?>" class="btn btn-danger"  onclick="return confirm('Do you want to delete this employee?');"> Delete</a>
          </td>
        </tr>
      <?php } ?>

    </tbody>
  </table>

  <!-- Add Modal -->
  <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Employee</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="add_employee_form">
          <div class="modal-body">
            <fieldset>
              <div class="form-group">
                <label for="exampleInputEmail1" class="form-label mt-4">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp" placeholder="Enter your first name" required>

              </div>
              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter your last name" required>
            </fieldset>
          </div>
          <div class="modal-footer">
            <button type="submit" id="add_employee" class="btn btn-primary">Submit</button>
          </div>
      </div>
      </form>
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Employee</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="add_employee_form">
          <div class="modal-body">
            <input type="hidden" id="employee_id" name="employee_id"/>
            <fieldset>
              <div class="form-group">
                <label for="exampleInputEmail1" class="form-label mt-4">First Name</label>
                <input type="text" class="form-control" id="edit_fname" name="fname" aria-describedby="emailHelp" placeholder="Enter your first name" required>

              </div>
              <div class="form-group">
                <label for="exampleInputPassword1" class="form-label mt-4">Last Name</label>
                <input type="text" class="form-control" id="edit_lname" name="lname" placeholder="Enter your last name" required>
            </fieldset>
          </div>
          <div class="modal-footer">
            <button type="submit" id="edit_employee" class="btn btn-primary">Submit</button>
          </div>
      </div>
      </form>
    </div>
  </div>
</section>



<?php $this->load->view('layouts/footer.php'); ?>

<script type="text/javascript">
  $('#employeetable').DataTable();

  $("#add_employee").click(function(e) {
    e.preventDefault();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    $('#employeeModal').modal('hide')
    $.ajax({
      url: "<?php echo base_url('Employees/add_employee'); ?>",
      method: "POST",
      data: {
        fname: fname,
        lname: lname
      },
      success: function(data) {
        Swal.fire({
          text: "Employee successfully added!",
          icon: 'success',
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.reload();
          }
        })

      },
      error: function() {
        alert("Please enter valid fields");
      }
    });
  });

  $(".update_employee_btn").click(function(e) {
    e.preventDefault();
    var fname = $(this).attr("data-fname");
    var lname = $(this).attr("data-lname");
    var id = $(this).attr("data-id");
    $('#edit_fname').val(fname);
    $('#edit_lname').val(lname);
    $('#employee_id').val(id);
    $('#edit_modal').modal('toggle');
  });

  $("#edit_employee").click(function(e) {
    e.preventDefault();
    var fname = $("#edit_fname").val();
    var lname = $("#edit_lname").val();
    var id = $("#employee_id").val();
    $('#employeeModal').modal('hide')
    $.ajax({
      url: "<?php echo base_url('Employees/edit_employee'); ?>",
      method: "POST",
      data: {
        fname: fname,
        lname: lname,
        id: id
      },
      success: function(data) {
        Swal.fire({
          text: "Employee successfully updated!",
          icon: 'success',
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.reload();
          }
        })

      },
      error: function() {
        alert("Please enter valid fields");
      }
    });
  });

</script>