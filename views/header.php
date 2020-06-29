<!DOCTYPE html>
<html lang="en">
  <head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous"> 

    
    <link rel="stylesheet" href="http://localhost:8080/reversetrade/views/css/styles.css">
    <link rel="stylesheet" href="http://localhost:8080/reversetrade/views/css/footerStyle.css">
      
    <!-- Arima Madurai Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">  


  

  </head>
  <body>
      
      <nav class="navbar navbar-light navbar-fixed-top bg-faded">
          <a class="navbar-brand" href="http://localhost:8080/reversetrade/">Home</a>
          <ul class="nav navbar-nav">
        
                    <li class="nav-item tip1">
                <?php if(isset($_SESSION['id'])){ ?>
                <a class="nav-link" href="?page=feed">Search</a>
                <?php }else{ ?>
                <a class="nav-link" href="?page=feed">Search</a>
                <?php }?>
            </li>
            <li class="nav-item tip2">
                <?php if(isset($_SESSION['id'])){ ?>
                <a class="nav-link" href="?page=posts">Your Posts</a>
                <?php }else{ ?>
                <a class="nav-link" href="?page=posts">Posts</a>
                <?php }?>

            </li>
            <li class="nav-item tip3">
              <a class="nav-link" href="?page=users">Users</a>
            </li>
            
          </ul>
          <div class="form-inline float-xs-right">
            
            <?php if(isset($_SESSION['id'])){ ?>   
              <a class="btn btn-outline-success" href="?function=logout">Logout</a>
            <?php }else{ ?>
            <button class="btn btn-outline-success" data-toggle="modal" data-target="#myModal">Login or Signup</button>
            <?php } ?>  
          </div>
      </nav>
      