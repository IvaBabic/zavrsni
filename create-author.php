<?php include_once('db.php') ?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    
    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body>
  <?php
    include('header.php');
  ?>  

  <?php
     if(isset($_POST['submit'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $gender = $_POST['gender'];
        
    
        if(empty($firstName) || empty($lastName)) {
          echo("Nesto nije popunjeno");
          return;
        } else {
          $sql = "INSERT INTO author 
          (first_name, last_name, gender)
          VALUES ('$firstName', '$lastName', '$gender');";
    
          $statement = $connection->prepare($sql);
          $statement->execute();
    
        };
      }
    


  ?>

<main role="main" class="container">
  <div class="row">
    <div class="col-sm-8 blog-main">
      <div class="blog-post">

      <form style="color: #b34848" action="create-author.php" method="POST" id="postsForm" class="test">
      <label for="fname">First Name</label>
      <input type="text" id="title" name="firstName" placeholder="FirstName" id="titlePosts">  <br>       
      <label for="fname">Last Name</label>
      <input type="text" name="lastName" placeholder="LastName" id="titlePosts"> <br>     
      <input type="radio" id="male" name="gender" value="male" required>
      <label for="male">Male</label><br>
      <input type="radio" id="female" name="gender" value="female">
      <label for="female">Female</label><br>
      <button class="ws-btn w3-block w3-margin-top w3-padding-16" type="submit" name="submit">Submit</button>
      </form>
           

      </div><!-- /.blog-post -->

        

     </div><!-- /.blog-main -->

    <?php
        include('sidebar.php');  
       ?>  

  </div><!-- /.row -->

</main><!-- /.container -->

    <?php
    include('footer.php');
    ?>  

</body>
</html>