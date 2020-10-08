<?php
require 'db.inc.php';
session_start();
$user_id = $_SESSION['userId'];
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Task</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <!-- Mainly scripts -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery.metisMenu.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <!-- Custom and plugin javascript -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="three.css" rel="stylesheet" >
    <script src="js/custom.js"></script>
    <script src="js/screenfull.js"></script>
    <script>
        $(function() {
            $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

            if (!screenfull.enabled) {
                return false;
            }



            $('#toggle').click(function() {
                screenfull.toggle($('#container')[0]);
            });



        });
    </script>

    <script src="js/skycons.js"></script>

</head>

<body>
    <div id="wrapper">

        <!----->
        <nav class="navbar-default navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h1> <a class="navbar-brand" href="index.php">TODO App</a></h1>
            </div>
            <div class=" border-bottom">
                <div class="full-left">
                    <div class="clearfix"> </div>
                </div>


                <!-- Brand and toggle get grouped for better mobile display -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="drop-men">
                    <ul class=" nav_1">
                        <li class="dropdown" style="padding:20px;">
                            <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret"><?php echo $_SESSION['fullname']?><i class="caret"></i></span>
                                <ul class="dropdown-menu " role="menu">
                                    <li><a href="home.php"><i class="fa fa-clipboard"></i>Logout</a></li>
                                </ul>
                        </li>

                    </ul>
                </div><!-- /.navbar-collapse -->
                <div class="clearfix">

                </div>

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">

                            <li>
                                <a href="dashboard.php" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span> </a>
                            </li>

                            <li>
                                <a href="task.php" class=" hvr-bounce-to-right"><i class="fa fa-inbox nav_icon"></i> <span class="nav-label">Tasks</span> </a>
                            </li>

                            <li>
                                <a href="home.php" class=" hvr-bounce-to-right"><i class="fa fa-picture-o nav_icon"></i> <span class="nav-label">Logout</span> </a>
                            </li>

                        </ul>
                    </div>
                </div>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="content-main">

                <!--banner-->
                <div class="banner">

                    <h2>
                        <a href="index.html">Home</a>
                        <i class="fa fa-angle-right"></i>
                        <span>Tasks</span>
                    </h2>
                </div>
                <!--//banner-->
                <!--content-->
                <div class="content-top">

                    <div class="col-md-14">
                        <!-- <div class="main-section"> -->
                        <div class="add-section">
                            <form action="add.php" method="POST" autocomplete="off">
                                <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>&nbsp;&nbsp;&nbsp;&nbsp;Task</label><i class="text-danger"></i>
                                                        <input type="text" name="title" placeholder="This field is required" style="border-color: #ff6666 ;">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>&nbsp;&nbsp;Due Date</label><i class="text-danger"></i>
                                                        <input type="datetime-local" name="dueDate" style="border-color: #ff6666 ;">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                                <?php } else { ?>

                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>&nbsp;&nbsp;&nbsp;&nbsp;Task</label><i class="text-danger"></i>
                                                        <input type="text" name="title" placeholder="What do you need to do">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>&nbsp;&nbsp;Due Date</label><i class="text-danger"></i>
                                                        <input type="datetime-local" name="dueDate" >
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                                <?php } ?>
                            </form>
                        </div>

                        <?php
                        $todos = $conn->query("SELECT * FROM todos where user_id = '$user_id' ORDER BY id DESC");
                        // $todos = $conn->query("SELECT * FROM todos where user_id =  ORDER BY id DESC");
                        ?>
                        <div class="show-todo-section">
                            <?php if ($todos->rowCount() <= 0) { ?>
                                <div class="todo-item">
                                    <div class="empty">
                                        <img src="img/clipart.jpg" width="90%" height="250px"><br>
                                        <img src="img/ellipsis.gif" width="80px">
                                    </div>
                                </div>
                            <?php } ?>

                            <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                                <div class="todo-item">
                                    <span id="<?php echo $todo['id']; ?>" class="remove-to-do">x</span>
                                    <?php if ($todo['checked']) { ?>
                                        <input type="checkbox" class="check-box" data-todo-id="<?php echo $todo['id']; ?>" checked />
                                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                                    <?php } else { ?>
                                        <input type="checkbox" data-todo-id="<?php echo $todo['id']; ?>" class="check-box" />
                                        <h2><?php echo $todo['title'] ?></h2>
                                    <?php } ?>
                                    <br>
                                    <small>created: <?php echo $todo['date_time'] ?></small>
                                    <small>due: <?php echo $todo['dueDate'] ?></small>
                                    <a href="#" ><buuton><span class="share-to-do">Share  &nbsp<i class="fa fa-envelope"></i></span></buuton></a>
                                    <!-- <button type="submit"  >Add &nbsp; <span>&#43;</span></button> -->
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="copy">
                    <p> Copyright 2020. All Rights Reserved | Design by Chello </p>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!---->
    <!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    <script src="js/bootstrap.min.js"> </script>

    <script>
        $(document).ready(function() {
            $('.remove-to-do').click(function() {
                const id = $(this).attr('id');

                $.post('remove.php', {
                        id: id
                    },
                    (data) => {
                        if (data) {
                            $(this).parent().hide(600);
                        }
                    }
                );
            });

            $(".check-box").click(function(e) {
                const id = $(this).attr('data-todo-id');

                $.post('check.php', {
                        id: id
                    },
                    (data) => {
                        if (data != 'error') {
                            const h2 = $(this).next();
                            if (data === '1') {
                                h2.removeClass('checked');
                            } else {
                                h2.addClass('checked');
                            }
                        }
                    }
                );
            });

            $(".share-to-do").click(function(){
                swal({
                title: 'Enter email address',
                input: 'text',
                });
            });
        });
    </script>
    <!-- <script src="https://kit.fontawesome.com/42f9d22897.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
</body>

</html>