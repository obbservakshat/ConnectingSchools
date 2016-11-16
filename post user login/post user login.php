<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Connecting Schools A Modern Platform for Modern Schools</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/heroic-features.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<?php
   $m = new MongoClient();
   $db = $m->connectingschools;
   //echo "Database mydb selected";
   $event = $db->createCollection("Event");
   $cursor = $event->find();
?>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="../index.php">Connecting Schools</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                 <!-- <li>
                      <a href="../about.html">About Us</a>
                  </li>-->
                  <li>
                              <a href="../addevents/form.php">Create Event</a>
                  </li>
                  <li>
                              <a href="../history/history.php">History</a>
                  </li>

                  <!--<li>
                      <a href="../contact.html">Contact Us</a>
                  </li>-->
                  <?php
                          if($_SESSION["uname"]==" ")
                          {
                              header("Location:../login/login.php");
                          }

                  ?>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo "Hello " . $_SESSION["uname"] ?><b class="caret"></b></a>
                      <ul class="dropdown-menu">

                          <li>
                              <a href="../index.php">Logout</a>
                          </li>
                      </ul>
                  </li>

              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
  </nav>


    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>A Warm Welcome <?php echo $_SESSION["uname"] ?> !</h1>

            </p>
        </header>

        <hr>


        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Upcoming Events</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

        <?php
          foreach($cursor as $document)
         {

          if($document["Status"]=="1") {
                ?>


            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="images/1.jpg" alt="">
                    <div class="caption">
                        <h3><?php echo $document["Title"];  ?></h3>
                        <p><?php echo $document["Details"]; ?></p>
                        <p>
                             <a href=<?php echo $document["Link"]; ?> class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
            <?php } }?>

        </div>


        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; 2016 Connecting Schools. All rights reserved</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
<?php
  $m->close();
?>
</body>

</html>
