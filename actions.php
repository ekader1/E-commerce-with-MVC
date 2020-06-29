<?php
    
   

    include("controller.php");
    
    //loginSignup action
    if($_GET['actions'] == "loginSignup"){
        
        $error = "";
        
        //if email field is empty
        if(!$_POST['email']){
            
            $error = "An email address is required";
        
        //if password field is empty
        }else if(!$_POST['password']){
            
            $error = "A password is required";
        
        //if not a valid email is used
        }else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            
            $error = "Please enter a valid email address";
            
        }
        
        //discontinue if error is there
        if($error != ""){
            echo $error;
            exit();
        }
        
        //if user wants to sign up
        if($_POST['loginActive'] == "0"){
            
            $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result) > 0){
                $error = "That email address is already taken";
            }else{
                $query = "INSERT INTO users (`email`, `password`) VALUES('".mysqli_real_escape_string($link, $_POST['email'])."','".mysqli_real_escape_string($link, $_POST['password'])."')";
                if(mysqli_query($link, $query)){
                    $_SESSION['id'] = mysqli_insert_id($link);
                    $query = "UPDATE users SET password = '".md5(md5($_SESSION['id']).$_POST['password'])."' WHERE id = '".$_SESSION['id']."' LIMIT 1";
                    mysqli_query($link, $query);
                    echo 1;
                }else{
                    $error = "Sorry, our bad! Couldn't add ya, Please try again later";
                }
            }
        //if user wants to log in  
        }else{
            $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_assoc($result);
            if($row['password'] == md5(md5($row['id']).$_POST['password'])){
                echo 1;
                $_SESSION['id'] = $row['id'];
            }else{
                $error = "Sorry, could not find this user. Did you enter the correct login credentials?";
            }
        }
        
        if($error != ""){
            echo $error;
            exit();
        }
        
    }

    if($_GET['actions'] == 'toggleFollow'){
        
        if(isset($_SESSION['id']))
                $query = "SELECT * FROM followingdata WHERE follower = '".mysqli_real_escape_string($link, $_SESSION['id'])."' AND isFollowing = '".mysqli_real_escape_string($link, $_POST['userId'])."' LIMIT 1";
                $result = mysqli_query($link, $query);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                    $check = mysqli_query($link, "DELETE FROM followingdata WHERE id = '".mysqli_real_escape_string($link, $row['id'])."' LIMIT 1 ");
                    if($check)
                        echo "1";
                }else{
                    $check = mysqli_query($link, "INSERT INTO followingdata (`follower`, `isFollowing`) VALUES (".mysqli_real_escape_string($link, $_SESSION['id']).",".mysqli_real_escape_string($link, $_POST['userId']).")");
                    if($check)
                        echo "2";
                }
        }

    //action for posting a post
    if($_GET['actions'] == 'postPost'){
        if(!$_POST['postPost']){
            echo "We didn't found any content in your post!";
        }else if(strlen($_POST['postPost']) > 140){
            echo "Your post is too long. Please make necessary changes";
        }else{
            //echo "Post Successful";
            $query = "INSERT INTO posts (`post`, `userid`, `datetime`) VALUES('".mysqli_real_escape_string($link, $_POST['postPost'])."',".mysqli_real_escape_string($link, $_SESSION['id']).", NOW())";
            mysqli_query($link, $query);
            echo "1";
        }
    }
    
    //action for deleting a post
    if($_GET['actions'] == 'deletePost'){
        //echo "Delete Successful ".$_POST['id'];
        $query = "DELETE FROM posts WHERE  id = '".$_POST['id']."' LIMIT 1";
        $result = mysqli_query($link, $query);
        if(true)
            echo "1";
        else
            echo "2";
        
    }

?>
