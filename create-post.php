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

  if(isset($_POST['submit'])) {
    $body = $_POST['body'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $currentDate = date("Y-m-d h:i");

    if(empty($body) || empty($title) || empty($author)) {
      echo("Nesto nije popunjeno");
      return;
    } else {
      $sql = "INSERT INTO posts 
      (title, body, author, created_at)
      VALUES ('$title', '$body', '$author', '$currentDate');";
    
      $statement = $connection->prepare($sql);
      $statement->execute();
     header('Location: posts.php');

    };
  }

?>

  

<main role="main" class="container">

<div class="row">

    <div class="col-sm-8 blog-main">

        <div class="blog-post">
  

  <div>
    <form style="color: #b34848" action="create-post.php" method="POST" id="postsForm" class="test">
      <label for="fname">Title</label>
      <input type="text" id="title" name="title" placeholder="Title" id="titlePosts">  <br>       
      <label for="fname">Name</label>
      <input type="text" name="author" placeholder="author" id="titlePosts"> <br>     
      <label for="fname">Body</label>
      <textarea name="body" placeholder ="Enter Post" rows = "10" id="bodyPosts"></textarea><br>

    
      <button class="ws-btn w3-block w3-margin-top w3-padding-16" type="submit" name="submit">Submit</button>

    
    </form>
  </div>

  </div>
  </div>

  <?php
  include('sidebar.php');
  ?>

</div>

</main>


<?php
   
    
    include('footer.php');
?>  


</body>
</html>