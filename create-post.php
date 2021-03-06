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

  $sql_authors = "SELECT CONCAT(first_name, ' ', last_name) as fullName, id, gender FROM author;";
  $statement = $connection->prepare($sql_authors);
  $statement->execute();
  $statement->setFetchMode(PDO::FETCH_ASSOC);
  $authors = $statement->fetchAll(); 
  
  
  

  

  if(isset($_POST['submit'])) {
    $body = $_POST['body'];
    $title = $_POST['title'];
    $authorID = $_POST['author'];
    $currentDate = date("Y-m-d h:i");

    $sql_author = "SELECT CONCAT(first_name, ' ', last_name) as fullName FROM author WHERE id = $authorID;";
    $statement = $connection->prepare($sql_author);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $author = $statement->fetch();
    $authorName = $author['fullName'];

    

    if(empty($body) || empty($title) || empty($author)) {
      echo("Nesto nije popunjeno");
      return;
    } else {
      $sql = "INSERT INTO posts 
      (title, body, created_at, author_id, author)
      VALUES ('$title', '$body', '$currentDate', '$authorID', '$authorName');";
    
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
  

  <div class="form_create_post">
    <form style="color: #b34848" action="create-post.php" method="POST" id="postsForm" class="test">
      <label for="author">Author</label>
      <select name="author">
         <option selected="selected">Choose one</option>
         <?php
          foreach($authors as $person) { ?>
          <option <?php if($person['gender'] == 'male') { ?> style="color: blue" <?php } else {?> style="color:pink" <?php }?>
            value="<?= $person['id'] ?>"><?= $person['fullName'] ?></option>
          <?php
           } ?>
      </select> 
      
      <label for="fname">Title</label>
      <input type="text" id="title" name="title" placeholder="Title" id="titlePosts">  <br> 
      <label for="body">Body</label>
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