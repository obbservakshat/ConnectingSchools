<!DOCTYPE html>
<html lang="en">
<head>
	
</head>
<?php
   $m = new MongoClient();
   $db = $m->connectingschools;
   //echo "Database mydb selected";
   $school = $db->createCollection("School");
   $student = $db->createCollection("Student");
   $supervisor = $db->createCollection("Supervisor");

    $cursor = $student->find("Password":"akshat");
   // iterate cursor to display title of documents
	
   foreach ($cursor as $document) {
     
                ?>
                     <h1><?php echo $document["Name"] . "\n";  ?>  </h1>
               <?php
            }
               ?>

<body>
	

</body>




</html>