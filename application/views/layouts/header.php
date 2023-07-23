<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Timerecord</title>

  <link href="<?php echo base_url() ?>assets/css/theme.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

</head>

<body>
  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo base_url() ?>">Timerecord</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <?php if (array_key_exists('user_name', $_SESSION) && !empty($_SESSION['user_name'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() . "employees" ?>">Employees
                <span class="visually-hidden">(current)</span>
              </a>
            </li>

            <?php if ($_SESSION['user_type'] == 1) { ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url() . "users" ?>">Users</a>
              </li>
            <?php } ?>
          <?php } ?>

        </ul>
        <form class="d-flex">
          <?php if (array_key_exists('user_name', $_SESSION) && !empty($_SESSION['user_name'])) { ?>
            <a class="navbar-brand" href=""><?php echo $_SESSION['user_name'] ?></a>
            <a href="<?php echo base_url() . "Users/logout" ?>" class="btn btn-danger">Logout</a>
          <?php } ?>
        </form>
      </div>
    </div>
  </nav>