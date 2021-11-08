<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="images/favicon-32x32.png" type="image/png" sizes="16x16">
    <!-- included meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iDiscuss | An Online Discussion Forum</title>
    <style>
    .nounderline {
        text-decoration: none !important
    }
    </style>
</head>

<body>
   <?php
        include 'partials/_header.php';
        include 'partials/_dbconnect.php';
        if(!$conn)
            die();
      
    ?>
    <div class="container">
        <h1 class="py-2 text-center">Browse Questions</h1>
        <div class="row">
            <?php
            $page_id=$_GET['user_id']; // get request on user_id
            $query="SELECT * FROM `threads` WHERE thread_user_id=$page_id ORDER BY timestamp DESC;";
            $result=mysqli_query($conn,$query);
            $no_result=true;
            while($row=mysqli_fetch_assoc($result))
            {   $no_result=false;
                $thread_id=$row['thread_id'];
                $thread_user_name=$row['thread_user_name'];
                $timestame=$row['timestamp'];
                $thread_category_id=$row['thread_category_id'];
                $same_user=false;
                if(@is_null($_SESSION['user_id']))
                {
                    $same_user=false;
                }
                else
                {
                    $user_id=$_SESSION['user_id'];
                    if($user_id==$page_id)
                        $same_user=true;
                    else
                        $same_user=false;
                }
                echo ' 
                <div class="container">
                <div class="row align-items-start">
                    <div class="col">
                        <img src="images/default_user.png" width="30px">
                    </div>
                    <div class="col">
                    </div>
                    <div class="col">
                    posted by <b>'.$thread_user_name.'</b> at : '.$timestame.'    
                    </div>
                    <div class="col">';
                    if($same_user)
                    echo '<button class="btn btn-outline-success my-2 mb-1" data-bs-toggle="modal" data-bs-target="#delete_post_modal">Delete Post</button>';
                    echo '
                    </div>
                    <div class="row">
                    <a class="nounderline link-dark" href="thread.php?category_id='.$thread_category_id.'&thread_id='.$thread_id.'">
                    <h5 class="mt-0">'.$row['thread_title'].'</h5>
                    <p class="text-truncate my-2" style="max-width: 1000px;">
                    '.$row['thread_description'].'
                    </p></a>
                    </div>
                ';
            }
            if($no_result)
            {
                // no user exist
                echo '<div class="jumbotron jumbotron-fluid bg-dark text-light">
                <div class="container">
                  <h1 class="display-10 "><b>No user exit with this id</b></h1>
                  <p class="lead">Please try again <!DOCTYPE html></p>
                </div>
              </div>';
            }
            ?>
        </div>
    </div>
    <?php
        include 'partials/_footer.php'
    ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</body>

</html>