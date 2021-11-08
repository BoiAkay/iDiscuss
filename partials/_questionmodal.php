<?php
    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
    {
        $thread_title=$_POST['question_title'];
        $thread_description=$_POST['question_description'];
        $thread_category_id=$page_id;
        $thread_user_id=$_SESSION['user_id'];
        $thread_user_name=$_SESSION['user_name'];
        $query="select * from `threads` where thread_title='$thread_title' and thread_description='$thread_description'";
        $result=mysqli_query($conn,$query);
        
        $row=mysqli_fetch_assoc($result);
        if($row==0)
        {
        $query="INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_category_id`, `thread_user_id`, `thread_user_name`, `timestamp`) VALUES ('$thread_title', '$thread_description', '$thread_category_id', '$thread_user_id', '$thread_user_name', current_timestamp());";
        $result=mysqli_query($conn,$query);
        if($result)
        {
           echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>You question is posted!</strong> Wait some one to reply.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Your question is not added!</strong> Try again later.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
    }
?>
<!-- Modal -->
<div class="modal fade text-dark" id="questionmodal" tabindex="-1" aria-labelledby="questionmodalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="questionmodalLabel">Elaborate your concern</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php $url=$_SERVER['REQUEST_URI']; echo $url; ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="question_title" class="form-label">Question Title</label>
                        <input type="text" class="form-control" id="question_title" name="question_title">
                    </div>
                    <div class="mb-3">
                        <label for="question_description" class="form-label">Question Description</label>
                        <!-- <input type="text" class="form-control" id="question_description" name="question_description"> -->
                        <textarea class="form-control" id="question_description" name="question_description"
                            rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post my question</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>