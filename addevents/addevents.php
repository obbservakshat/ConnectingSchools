<?php
$msg='';
if(isset($_POST['Submit'])){
    // =============  File Upload Code d  ===========================================
    $target_dir = "/var/www/html/event_poster/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if file already exists
    if (file_exists($target_file)) {
        $msg= "Sorry, file already exists.";
        $uploadOk = 0;
    }
     // Check file size -- Kept for 500Mb
    if ($_FILES["fileToUpload"]["size"] > 800000000) {
        $msg= "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpeg" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif") {
       $msg= "Sorry, only wmv, mp4 & avi files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
     if($uploadOk!=0) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
           
           
            $v_link="event_poster/".$_FILES["fileToUpload"]["name"];
            
            $document = array(
                    "Title" => $_POST["Title"] ,
                    "Schoolname" => $_POST["Schoolname"] ,
                    "Type" => $_POST["Type"],
                    "Details" => $_POST["Details"],
                    "Startdate" => $_POST["Startdate"],
                    "Starttime" => $_POST["Starttime"],
                    "Endtime" => $_POST["Endtime"],
                    "Expectedstrength" => $_POST["Expectedstrength"],
                    "Budget" => $_POST["Budget"],
                    "Venue" => $_POST["Venue"],
                    "Link" => $_POST["Link"],
                    "Fee" => $_POST["Fee"],
                    "Email" => $_POST["Email"],
                    "Submittedby" => $_SESSION["uname"],
                    "Status" => "0",
                    "Pic" => $v_link
                    );
                $event->insert($document);
                header("Location:../post user login/post user login.php");
        } else {
            $msg= "Sorry, there was an error uploading your file.";
        }
    }
    }