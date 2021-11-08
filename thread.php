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
        $category_id=$_GET['category_id'];
        $thread_id=$_GET['thread_id'];
        $query="SELECT * FROM `threads` WHERE thread_id=$thread_id and thread_category_id=$category_id;";
        $result=mysqli_query($conn,$query);
        $thread_title;
        $thread_description;
        $thread_user_name;
        while($row=mysqli_fetch_assoc($result))
        {   $thread_title=$row['thread_title'];
            $thread_description=$row['thread_description'];
            $thread_user_name=$row['thread_user_name'];
            $thread_user_id=$row['thread_user_id'];
        }
    ?>
    <div class="container my-4">
        <div class="container bg-dark text-light">
            <div class="jumbotron">
                <h1 class="display-10 text-center"><?php echo $thread_title;?></h1>
                <p class="text-justify">
                    <?php
                        echo wordwrap($thread_description,280,"<br>",TRUE);
                    ?>
                    
                </p>
                <p class="text-end">Posted by : <b><?php echo $thread_user_name; ?></b></p>
                <hr class="my-3">
                <small id="emailHelp" class="form-text text-light">
                    <ul>
                        <li> This is a peer to peer forum.</li>
                        <li>No Spam / Advertising / Self-promote in the forums is not allowed.</li>
                        <li>Do not post copyright-infringing material. </li>
                        <li>Do not post “offensive” posts, links or images.</li>
                        <li>Do not cross post questions. </li>
                        <li>Remain respectful of other members at all times.</li>
                    </ul>
                </small>
                <?php
                    // session_start();
                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
                    {   // include comment modal
                        include 'partials/_commentmodal.php';
                        // user is inside
                        echo '<a class="btn btn-success btn-lg mb-2" data-toggle="tooltip" data-placement="top"
                        title="Create a modal to post questions. Also Check whether user is login before posting" href="#"
                        role="button" data-bs-toggle="modal" data-bs-target="#commentmodal">Post a comment</a>';
                        
                        echo '<a class="btn btn-success btn-lg mb-2 mx-2" data-toggle="tooltip" data-placement="top"
                        title="Create a modal to post questions. Also Check whether user is login before posting" href="#"
                        role="button" data-bs-toggle="modal" data-bs-target="#commentmodal">Report Question</a>';
                        if($_SESSION['user_id']==$thread_user_id) // check thread user id
                        {
                        echo '<a class="btn btn-success btn-lg mb-2" data-toggle="tooltip" data-placement="top"
                        title="Create a modal to post questions. Also Check whether user is login before posting" href="#"
                        role="button" data-bs-toggle="modal" data-bs-target="#commentmodal">Delete Question</a>';
                        }        
                    }
                    else
                    {
                        echo '<a class="btn btn-success btn-lg mb-2" data-toggle="tooltip" data-placement="top"
                        title="Create a modal to post questions. Also Check whether user is login before posting" href="#"
                        role="button" data-bs-toggle="modal" data-bs-target="#loginmodal">Login to Post a comment</a>';

                    }
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="py-2">Browse Comments</h1>
        <div class="row">
            <?php
                
            $query = "select * from `comments` where thread_id=$thread_id ORDER BY comment_time DESC";
            $result=mysqli_query($conn,$query);
            $no_result=true;
            while($row=mysqli_fetch_assoc($result))
            {   $no_result=false;
                $comment_content=$row['comment_content'];
                $comment_user_name=$row['comment_user_name'];
                $comment_user_id=$row['comment_user_id'];
               // comment content
                echo '
                <div class="container">
                <div class="row align-items-start">
                    <div class="col">
                        <img src="images/default_user.png" width="30px">
                    </div>
                    <div class="col">
                    posted by <b>'.$comment_user_name.'</b>
                    </div>
                    <div class="col">';

                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
                    {
                        echo '<div class="dropdown">
                            <button class="btn dropdown-toggle position-absolute bottom-0 end-0" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="true">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="btn btn-outline-success dropdown-item" href="#">report</a></li>';

                            if($_SESSION['user_id']==$comment_user_id)
                            {
                                echo '<li><a class="btn btn-outline-success dropdown-item" href="#">delete</a></li>';
                            }


                        echo '</ul>
                        </div>';
                    }
            echo '
                        
                    </div>
                </div>
                <p class="text-justify">
                '.wordwrap($comment_content,150,"<br>",TRUE).'
                </p>
               
            </div>
                ';
            }
            if($no_result)
            {
                // no result be the first person to ask questions 
                echo '<div class="jumbotron jumbotron-fluid bg-dark text-light">
                <div class="container">
                  <h1 class="display-10 "><b>No Questions Found</b></h1>
                  <p class="lead">Be the first to comment!!!</p>
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
</body>

</html>