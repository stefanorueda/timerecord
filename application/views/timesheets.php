<?php $this->load->view('layouts/header.php'); ?>

<section class="container my-5">
    <a href="<?php echo base_url() . 'employees' ?>" class="btn btn-primary my-5">Go back</a>
    <h1>Timesheets for Employee <?php echo $this->uri->segment(3) ?></h1>
    <table class="table table-hover my-5" id="timesheetable">
        <thead>
            <tr class="table-primary">
                <th scope="col">ID</th>
                <th scope="col">Time</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $x = 1;
            foreach ($timesheets as $key) {

                ?>
                <tr>
                    <th scope="row"><?= $key->id ?></th>
                    <td><?= $key->date_added ?></td>
                    <td>
                        <?php
                            if ($key->time_in) { ?>
                            <span class="badge bg-success">Timein</span>
                        <?php
                            }
                            ?>
                        <?php
                            if ($key->time_out) { ?>
                            <span class="badge bg-danger">Timeout</span>
                        <?php
                            }
                            ?>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>

    <script type="text/javascript">
        $('#timesheetable').DataTable();
    </script>


</section>

<?php $this->load->view('layouts/footer.php'); ?>