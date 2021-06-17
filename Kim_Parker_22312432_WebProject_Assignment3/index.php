<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=2">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>SCP Web Application</title>
  </head>
  <body class="container">
      
      <div class="bg-dark jumbotron" style="margin-bottom: 0px;">
          <h1 class="p-3 mb-2 text-info display-1 font-weight-bolder">SCP Web Application</h1>
          
      </div>
      
      <?php include "connection.php";?>
      <ul class="nav">
          
          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
          
          <!-- run php loop through DB and display item names here-->
          <?php foreach($result as $item): ?>
          
           <li class="nav-item">
               <a href="index.php?scp='<?php echo $item['item']; ?>'" class="nav-link"><?php echo $item['item']; ?></a>
         </li>
            
          <?php endforeach; ?>
          
          <li class="nav-item"><a href="create.php" class="nav-link">Create New SCP Record</a></li>
      </ul>
      
    <?php
    
        if(isset($_GET['scp']))
        {
            //remove single quotes or %27 from GET value
            $scp = trim($_GET['scp'], "'");
            
            //run sql query based on our $scp get value
            $record = $mysqli->query("select * from scp where item='$scp'") or die($mysqli->error);
            
            //convert $record into an associative array
            $row = $record->fetch_assoc();
            
            //update and delete variables
            $id = $row['id'];
            $update = 'update.php?update=' . $id;
            $delete = 'connection.php?delete=' . $id;
            $image = $row['image'];
            
            //diplay the record on screen
            echo "
                    <h1>{$row['item']}</h1>
                    <h2>{$row['class']}</h2>
                    <h3>Description</h3>
                    <p>{$row['description']} class='text-secondary'</p>
                    <h3>Containment</h3>
                    <p>{$row['containment']}</p>
                    <p><img src='{$image}'></p>
                    <p>
                        <a href='{$update}' class='btn btn-info'>Update</a>
                        <a href='{$delete}' class='btn btn-dark'>Delete</a>
                    </p>
            ";
        }
        else
        {
            echo "
                
                <h1>Welcome to SCP Page</h1>
                <p>Click on the links above to view an SCP Subject</p>
                
                
            ";
        } 
    
    ?>
   
    

    
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>