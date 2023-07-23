<?php $this->load->view('layouts/header.php'); ?>
<section class="container-fluid my-5">
    <div class="row">
        <div class="col-md">
            <div class="clock">
                <div id="Date"></div>
                <ul>
                    <li id="hours"></li>
                    <li id="point">:</li>
                    <li id="min"></li>
                    <li id="point">:</li>
                    <li id="sec"></li>
                </ul>
            </div>

            <div class="container-fluid my-5 px-5" id="time_in">
                <div class="row">
                    <input type="hidden" name="id" id="id" />
                    <button type="button" class="btn btn-success btn-lg" id="time_in_btn">Time IN</button>
                </div>
            </div>

            <div class="container-fluid my-5 px-5" id="time_out">
                <div class="row">
                    <input type="hidden" name="id2" id="id2" />
                    <button type="button" class="btn btn-danger btn-lg" id="time_out_btn">Time OUT</button>
                </div>
            </div>

            <div class="container-fluid my-5 px-5" id="record_form">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="form-label mt-4"><strong>Enter your Employee ID</strong></label>
                            <input type="number" class="form-control" name="employee_id" id="employee_id" placeholder="Employee ID">
                        </div>
                    </div>
                    <div class="col-sm-2 text-center">
                        <p class="my-5"><strong>OR</strong></p>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group mt-5">
                            <!-- <label for="formFile" class="form-label mt-4 font-weight-bold"><strong>Upload QR</strong></label> -->
                            <button type="button" class="btn btn-outline-primary">Scan QR Code</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-primary" id="enter_btn">Enter</button>
                </div>
            </div>

        </div>
        <div class="col-md">

            <?php if (!array_key_exists('user_name', $_SESSION) && empty($_SESSION['user_name'])) { ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form>
                                <fieldset>
                                    <legend>Login</legend>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label mt-4">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp" placeholder="Enter username">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                    </div>

                                    <button type="button" class="btn btn-primary my-5" id="login">Enter</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php if (array_key_exists('user_name', $_SESSION) && !empty($_SESSION['user_name'])) { ?>
                <h1>Welcome, <?php echo $_SESSION['user_name'] ?>!</h1>


            <?php } ?>


        </div>
    </div>
</section>

<?php $this->load->view('layouts/footer.php'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $("#time_in").hide();
        $("#time_out").hide();
        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
        var newDate = new Date();
        newDate.setDate(newDate.getDate());
        $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

        setInterval(function() {

            var seconds = new Date().getSeconds();

            $("#sec").html((seconds < 10 ? "0" : "") + seconds);
        }, 1000);

        setInterval(function() {

            var minutes = new Date().getMinutes();

            $("#min").html((minutes < 10 ? "0" : "") + minutes);
        }, 1000);

        setInterval(function() {

            var hours = new Date().getHours();

            $("#hours").html((hours < 10 ? "0" : "") + hours);
        }, 1000);

        $("#enter_btn").click(function(e) {
            e.preventDefault();
            var id = $("#employee_id").val();

            $.ajax({
                url: "<?php echo base_url('Records/get_employee_records'); ?>",
                method: "POST",
                data: {
                    id: id,
                },
                success: function(data) {

                    if (data === "No records found") {
                        $("#record_form").hide();
                        $("#time_in").show();
                        $('#id').val(id);
                        $('#id2').val(id);
                    }

                    if (data === "timein") {
                        $("#record_form").hide();
                        $("#time_in").show();
                        $('#id').val(id);
                        $('#id2').val(id);
                    }

                    if (data === "timeout") {
                        $("#record_form").hide();
                        $("#time_out").show();
                        $('#id').val(id);
                        $('#id2').val(id);
                    }

                    if (data === "No employee found") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No employee found',
                        });
                    }


                },
                error: function() {
                    alert("Please enter valid fields");
                }
            });
        });

        $("#time_in_btn").click(function(e) {
            e.preventDefault();
            var id = $("#id").val();

            $.ajax({
                url: "<?php echo base_url('Records/time_in'); ?>",
                method: "POST",
                data: {
                    id: id,
                },
                success: function(data) {
                    Swal.fire({
                        text: "You have successfully time in!",
                        icon: 'success',
                    })
                    $("#record_form").show();
                    $("#time_in").hide();
                    $("#employee_id").val();


                },
                error: function() {
                    alert("Please enter valid fields");
                }
            });
        });

        $("#login").click(function(e) {
            e.preventDefault();

            var username = $("#username").val();
            var password = $("#password").val();

            $.ajax({
                url: "<?php echo base_url('Users/login'); ?>",
                method: "POST",
                data: {
                    username: username,
                    password: password
                },
                success: function(data) {
                    if (data === 'error2') {
                        Swal.fire({
                            text: "Login failed!",
                            icon: 'error',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    } else {
                        Swal.fire({
                            text: "Login successfully!",
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    }
                  

                },
                error: function() {
                    alert("Please enter valid fields");
                }
            });
        });

        $("#time_out_btn").click(function(e) {

            e.preventDefault();
            var id2 = $("#id2").val();

            $.ajax({
                url: "<?php echo base_url('Records/time_out'); ?>",
                method: "POST",
                data: {
                    id2: id2,
                },
                success: function(data) {
                    Swal.fire({
                        text: "You have successfully time out!",
                        icon: 'success',
                    })
                    $("#record_form").show();
                    $("#time_out").hide();
                    $("#employee_id").val();


                },
                error: function() {
                    alert("Please enter valid fields");
                }
            });
        });






    });
</script>

<style type="text/css">
    @font-face {
        font-family: 'BebasNeueRegular';
        src: url('BebasNeue-webfont.eot');
        src: url('BebasNeue-webfont.eot?#iefix') format('embedded-opentype'),
            url('BebasNeue-webfont.woff') format('woff'),
            url('BebasNeue-webfont.ttf') format('truetype'),
            url('BebasNeue-webfont.svg#BebasNeueRegular') format('svg');
        font-weight: normal;
        font-style: normal;
    }

    .container {
        width: 960px;
        margin: 0 auto;
        overflow: hidden;
    }

    .clock {
        width: 800px;
        margin: 0 auto;
        padding: 30px;
        border: 1px solid #333;
        color: #fff;
        background-color: #202020;
        border-radius: 25px;
    }

    #Date {
        font-family: 'BebasNeueRegular', Arial, Helvetica, sans-serif;
        font-size: 36px;
        text-align: center;
        text-shadow: 0 0 5px #00c6ff;
    }

    .clock ul {
        width: 800px;
        margin: 0 auto;
        padding: 0px;
        list-style: none;
        text-align: center;
    }

    .clock ul li {
        display: inline;
        font-size: 10em;
        text-align: center;
        font-family: 'BebasNeueRegular', Arial, Helvetica, sans-serif;
        text-shadow: 0 0 5px #00c6ff;
    }

    #point {
        position: relative;
        -moz-animation: mymove 1s ease infinite;
        -webkit-animation: mymove 1s ease infinite;
        padding-left: 10px;
        padding-right: 10px;
    }

    /* Simple Animation */
    @-webkit-keyframes mymove {
        0% {
            opacity: 1.0;
            text-shadow: 0 0 20px #00c6ff;
        }

        50% {
            opacity: 0;
            text-shadow: none;
        }

        100% {
            opacity: 1.0;
            text-shadow: 0 0 20px #00c6ff;
        }
    }

    @-moz-keyframes mymove {
        0% {
            opacity: 1.0;
            text-shadow: 0 0 20px #00c6ff;
        }

        50% {
            opacity: 0;
            text-shadow: none;
        }

        100% {
            opacity: 1.0;
            text-shadow: 0 0 20px #00c6ff;
        }

        ;
    }
</style>