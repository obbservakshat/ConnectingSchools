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
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<?php
    if($_SESSION["uname"]==" ")
    {
      header("Location:../index.php");
    }

?>

<?php
   $m = new MongoClient();
   $db = $m->connectingschools;
   //echo "Database mydb selected";
   $event = $db->createCollection("Event");
   $cursor = $event->find();
?>

<?php
 
  
  if(isset($_POST["Approve"]))
  {

        $id = $_POST["appdec"];
    $mongoID = new MongoID($id);

    $newdata = array('$set' => array("Status" => "1", "Message" =>$_POST["Message"]));
    
    $event->update(array("_id" => $mongoID ), $newdata , array("upsert" => true));
     

  }

  if(isset($_POST["Decline"]))
  {
    
    $id = $_POST["appdec"];
    $mongoID = new MongoID($id);

    $newdata = array('$set' => array("Status" => "-1", "Message" =>$_POST["Message"]));
    
    $event->update(array("_id" => $mongoID ), $newdata , array("upsert" => true));
  }

?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin.php">SuperVisor</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Hi Sir.Can you please approve my pending request!</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Applications<span class="label label-default">New</span></a>
                        </li>
                        <li>
                            <a href="#">Staff Requests<span class="label label-success">New</span></a>
                        </li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo "". $_SESSION["uname"] ;?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../login/login.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="applications.php"><i class="fa fa-fw fa-dashboard"></i>Applications</a>
                    </li>
                   	  
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
	 	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Applications
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i>Applications
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <?php

    foreach($cursor as $document)
    {

          if($document["Status"]=="0") {
                ?>

                <div class="row">
                   <div class="media">
  			<div class="media-left media-top">
    				<img src="avatar.jpeg" class="media-object" style="width:60px">
  			</div>
	  		<div class="media-body">
    				<h4 class="media-heading"><?php echo $document["Title"] ;  ?></h4>
				
     				<p> 
				<br>School Name- <?php echo $document["Schoolname"]; ?> </br>
				<br>Date(mm/dd/yyy)-<?php echo $document["Startdate"]; ?></br>
				<br>Genre - <?php echo $document["Type"]; ?> </br>
        <br>Start Time - <?php echo $document["Starttime"]; ?></br>
        <br>End Time - <?php echo $document["Endtime"]; ?></br>
        <br>Venue-<?php echo $document["Venue"]; ?></br>
        <br>Details - <?php echo $document["Details"]; ?></br>
        <br>Expected Strength - <?php echo $document["Expectedstrength"]; ?></br>
        <br>Budget - INR <?php echo $document["Budget"]; ?> /-</br>
        <br>Fee Per Head - INR <?php echo $document["Fee"]; ?> /-</br>
        <br>Email - <?php echo $document["Email"]; ?></br>
        <br>Event Link- <a href=<?php echo $document["Link"]; ?>> Event </a> </br>
        <br>Submitted By- <?php echo $document["Submittedby"]; ?></br>

				</p>

        <form action="applications.php" method="post">

        <textarea id="message" name="Message" placeholder="Any Message for Organizer." title="Please enter Event Details" required=""></textarea> 
        <input type ="hidden" name="appdec" value=<?= $document["_id"] ?>>
        
        <button name="Approve" type="submit" class="btn btn-success" >
         <span class="glyphicon glyphicon-ok">Approve</span></button>
        <!-- Modal -->
        
        <button name="Decline" type="submit" class="btn btn-danger" >
         <span class="glyphicon glyphicon-remove">Decline</span></button>



         </form>
			
				<hr> 	
  			</div>
            	  </div>
	       </div>	
          <?php } }?>
         	<!--	
		<div class="row">
                   <div class="media">
  			<div class="media-left media-top">
    				<img src="avatar.jpeg" class="media-object" style="width:60px">
  			</div>
	  		<div class="media-body">
    				<h4 class="media-heading">Annu Purohit</h4>
				<p class="small text-muted"><i class="fa fa-clock-o"></i>2:36 PM,6-08-2016</p>
     				<p>
				<br>School Name- MSS Public School,Marudhar Kesari Nagar,Raja Park,Jaipur</br>
				<br>Event-Art and Craft Fair</br>
				<br>Age Group-8-16 years</br>
				<br>Date-25-10-2016</br>
				<br>Registration fee-INR 200</br>
				<br>Upper Limit on Participants-None</br>
				<br>Additional Info-None</br>
				<br>Prize Money-INR-None</br>
				</p>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
				 <span class="glyphicon glyphicon-ok">Approve</span></button>
				
				<div id="myModal" class="modal fade" role="dialog">
  				<div class="modal-dialog">
    				
    				<div class="modal-content">
     					<div class="modal-header">
     			   			<button type="button" class="close" data-dismiss="modal">&times;</button>
       						<h4 class="modal-title">Success</h4>
      					</div>
      						<div class="modal-body">
      	 						<div class="alert alert-success">
  								The application has been approved!
							</div>
      						</div>
     						 <div class="modal-footer">
       						 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      						</div>
    						</div>
	
				  </div>
				</div>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#mmyModal">
				<span class="glyphicon glyphicon-remove">Decline</span></button>
			
				<div id="mmyModal" class="modal fade" role="dialog">
  				<div class="modal-dialog">
    				
    				<div class="modal-content">
     					<div class="modal-header">
     			   			<button type="button" class="close" data-dismiss="modal">&times;</button>
       						<h4 class="modal-title">Success</h4>
      					</div>
      						<div class="modal-body">
      	 						<div class="alert alert-danger">
  								The application has been declined!
							</div>
      						</div>
     						 <div class="modal-footer">
       						 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      						</div>
    						</div>
	
				  </div>
				</div>			
				
				<hr>
  			</div>
            	  </div>
	       </div>		
	 	<div class="row">
                   <div class="media">
  			<div class="media-left media-top">
    				<img src="avatar.jpeg" class="media-object" style="width:60px">
  			</div>
	  		<div class="media-body">
    				<h4 class="media-heading">Jitendra Rathore</h4>
				<p class="small text-muted"><i class="fa fa-clock-o"></i>10:05 PM,5-08-2016</p>
     				<p>
				<br>School Name-Laxmi Niwas Mittal Public School,Rupa ki Nangal,via-Jamdoli,Jaipur</br>
				<br>Event-Science Exhibition</br>
				<br>Age Group-8-16 years</br>
				<br>Date-17-October-2016</br>
				<br>Registration fee-INR 100</br>
				<br>Upper Limit on Participants-None</br>
				<br>Additional Info-None</br>
				<br>Prize Money-None</br>
				</p>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
				 <span class="glyphicon glyphicon-ok">Approve</span></button>
				
				<div id="myModal" class="modal fade" role="dialog">
  				<div class="modal-dialog">
    				
    				<div class="modal-content">
     					<div class="modal-header">
     			   			<button type="button" class="close" data-dismiss="modal">&times;</button>
       						<h4 class="modal-title">Success</h4>
      					</div>
      						<div class="modal-body">
      	 						<div class="alert alert-success">
  								The application has been approved!
							</div>
      						</div>
     						 <div class="modal-footer">
       						 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      						</div>
    						</div>
	
				  </div>
				</div>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#mmyModal">
				<span class="glyphicon glyphicon-remove">Decline</span></button>
				
				<div id="mmyModal" class="modal fade" role="dialog">
  				<div class="modal-dialog">
    				
    				<div class="modal-content">
     					<div class="modal-header">
     			   			<button type="button" class="close" data-dismiss="modal">&times;</button>
       						<h4 class="modal-title">Success</h4>
      					</div>
      						<div class="modal-body">
      	 						<div class="alert alert-danger">
  								The application has been declined!
							</div>
      						</div>
     						 <div class="modal-footer">
       						 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      						</div>
    						</div>
	
				  </div>
				</div>		
				<hr>  			
			</div>
            	  </div>
	       </div>
		<li>
                    <a href="admin.php">Back</a>
                </li>		               
        </div>
        

    </div> -->
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
