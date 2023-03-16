<?php
session_start();
$conn =mysqli_connect('localhost','root','','blog');
if(isset($_POST['start'])){
    $start =mysqli_real_escape_string($conn, $_POST['start']);

    $nm = $_SESSION['email'];
    $sql = "SELECT  `id`, `date`, `blog_title`, `banner_img`, `tags`,`color` FROM `post` limit $start,3 where `userid`= '$nm' order by id desc LIMIT 10";
    $result =mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)> 0){
    $html="";
    while($row=mysqli_fetch_assoc($result)){
        $html.='<div class="img_for_blogpost">
          <a href="theme/webmag/blog-post.php?userid=<?php echo $row['id'];?>"  rel="noopener noreferrer">
          <img src="<?php echo "uploads/". $row['banner_img'];?>" height="240px" width="100%" class="opecity" alt="" />
        </a>
        
        <!-- edit and delete option add -->
        <!-- onclick="myfun(this)" -->
        <div class="three-dots dotbtn" id="btn-edit">
        <i class="fa-solid fa-ellipsis-vertical dot"></i>
        </div>
        <div id="myDropdown" class="list1-content dropdown">

            <a href="post.php?id=<?php echo $row['id'];?>">Edit Post</a>
            <a href="delete_blog.php?id=<?php echo $row['id'];?>">Delete Post</a>
         </div>
        <div class="post_cate_date">                
           <p class="post_cate <?php echo $row['color'];?>"><?php echo $row['tags'];?></p>
          <p class="post_date"><?php echo date('F d, Y',strtotime($row['date'])); ?></p>
          
        </div>

        <a href="theme/webmag/blog-post.php?userid=<?php echo $row['id'];?>" target="_blank" rel="noopener noreferrer">
          <h5 class="post _heading"><?php echo $row['blog_title'];?></h5>
        </a>

      </div>'
    }
    echo $html;
}
}



?>