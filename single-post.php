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
    
      if (isset($_GET['id'])) {
        
        $sql = "SELECT * FROM posts WHERE posts.id = {$_GET['id']}";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $singlePost = $statement->fetch(); 

        $sqlComments = "SELECT * FROM comments 
                    WHERE comments.post_id = {$_GET['id']}";
        $statement = $connection->prepare($sqlComments);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $comments = $statement->fetchAll();

      }
     ?>  

<main role="main" class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
            <div class="blog-post">

                <h2 class="blog-post-title"> <?php echo $singlePost['title']; ?> </h2>
                <p class="blog-post-meta"><?php echo $singlePost['created_at'] ?> by <a href="#"> <?php echo $singlePost['author'] ?></a></p>
                <p> <?php echo $singlePost['body'] ?> </p>
        
            </div><!-- /.blog-post -->

            
            <h3>Comments</h3>
            <ul> 
              <?php
                foreach ($comments as $comment) {
              ?>
                <li>posted by: <strong><?php echo $comment['author'] ?></strong> 
                <p> <?php echo $comment['text'] ?> </p>
                </li>
                <hr>
                <?php } ?> 
            </ul>
            


            <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="posts.php">Back to all posts</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>

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