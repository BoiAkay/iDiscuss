<!-- Modal -->
<?php
    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
    {
        $comment_description=$_POST['comment_description'];
        $thread_id=$thread_id;
        $comment_user_id=$_SESSION['user_id'];
        $comment_user_name=$_SESSION['user_name'];
        $query="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_time`, `comment_user_id`,`comment_user_name`) VALUES ('$comment_description', '$thread_id', current_timestamp(), '$comment_user_id','$comment_user_name');";
        $result=mysqli_query($conn,$query);
        if($result)
        {
           echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>You comment is posted !</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Your comment is not added !</strong> Try again later.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
?>
<div class="modal fade text-dark" id="commentmodal" tabindex="-1" aria-labelledby="commentmodalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentmodalLabel">Post a comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php $url=$_SERVER['REQUEST_URI']; echo $url; ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="comment_description" class="form-label">Comment</label>
                        <textarea class="form-control" id="comment_description" name="comment_description"
                            rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post my comment</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>