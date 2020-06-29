<?php
    ini_set("date.timezone", "Asia/Kolkata");
    include("controller.php");
    include("views/header.php");
    
    if(isset($_GET['page'])){
        if($_GET['page'] == 'feed'){
            include("views/feed.php");
        }else if($_GET['page'] == 'posts'){
            include("views/yourPosts.php");
        }else if($_GET['page'] == 'search'){
            include("views/search.php");
        }else if($_GET['page'] == 'users'){
            include("views/users.php");
        }
    }else{
        include("views/home.php");
    }
    include("views/footer.php");
?>