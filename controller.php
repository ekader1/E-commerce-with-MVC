<?php
    
    //to start a session
    session_start();
    
    //link variable to store the db address and its details 
    $link = mysqli_connect("localhost", "root", "", "reversetrade");
    
    //if connection to db failed
    if(mysqli_connect_errno()){
        print_r(mysqli_connect_error());
        exit();
    }
    
    //if user presses 'logout' button then unset the session
    if (isset($_GET['function'])) {
        if($_GET['function'] == "logout"){
            session_unset();
        }
    }
    
    //function to display the time on post in 'time ago' format
    function timeSince($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'min'),
            array(1 , 'sec')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }

    
    //function to display display posts

    function displayPosts($type){
        
        global $link;
        $whereClause = "";
        $endQuery = 0;
        $noPostsForThisUser = 0;
        
    
        //if part is for user who are logged in
        if(isset($_SESSION['id'])){
            
            //if the logged in user is at the homePage
            //then show all posts
            if($type == "public"){

                $whereClause = "";
            
            //if the user is in the 'search' section
            //then show the posts of the users who the logged in user follows
            }else if($type == "isFollowing"){

                if(isset($_SESSION['id'])){

                    $query = "SELECT * FROM followingdata WHERE follower = ".mysqli_real_escape_string($link, $_SESSION['id']);

                    $result = mysqli_query($link, $query);

                    while($row = mysqli_fetch_assoc($result)){

                        if($whereClause == "")
                            $whereClause = "WHERE ";
                        else
                            $whereClause .= " OR ";

                        $whereClause .= "userid = ".$row['isFollowing'];
                    }

                }
                
            //if the user is at the 'your posts' section
            //then show the user's posts
            }else if($type == "yourPosts"){

                if(isset($_SESSION['id'])){

                    $whereClause = "WHERE userid = ".mysqli_real_escape_string($link, $_SESSION['id']);

                }
            
            //show results for when the user types in the search box
            }else if($type == "search"){
                
                echo '<p class="searchString">Showing results for "'.mysqli_real_escape_string($link, $_GET['query']).'"</p>';
                
                $whereClause = "WHERE post LIKE '%".mysqli_real_escape_string($link, $_GET['query'])."%' ";
              
            //if the user wants to view posts of a particular user
            
            }else if (is_numeric($type)){
                
             
                $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $type)." LIMIT 1";
             
                $userQueryResult = mysqli_query($link, $userQuery);
             
                $user = mysqli_fetch_assoc($userQueryResult);
                
                echo "<h2 class='heading'>".mysqli_real_escape_string($link, $user['email'])."'s Posts</h2>";
                
                $whereClause = "WHERE userid = ".mysqli_real_escape_string($link, $type);
                
                $noPostsForThisUser = 1;
                
            }
            
         
            $query = "SELECT * FROM posts ".$whereClause." ORDER BY `datetime` DESC";

            $result = mysqli_query($link, $query);
            
            
            if(mysqli_num_rows($result) == 0){
                
            
                if($noPostsForThisUser == 1){
                    
                    echo "<p class='display'>No post found from this user :(</p>";
                    
                }else{

                    echo "<p class='display'>There are no posts right now to show. Why don't you start post? :)</p>";
                
                }
                
        
            }else{
                
                while($row = mysqli_fetch_assoc($result)){

                    $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";

                    $userQueryResult = mysqli_query($link, $userQuery);

                    $user = mysqli_fetch_assoc($userQueryResult);

                    echo "<div class='post'><p><b><a href='?page=users&userid=".$user['id']."'>".$user['email']."</a></b> <span class='time'>".timeSince(time() - strtotime($row['datetime']))." ago </span></p>";

                    echo "<p><span class='postText'>".$row['post']."</span></p>";
                    
                    
                    if(isset($_SESSION['id'])){
                        
                        if($row['userid'] == $_SESSION['id']){
                            echo "<button class='btn btn-outline-danger deleteButton' data-toggle='modal' data-target='#deleteModal' data-id='".$row['id']."'>Delete</button>";
                        }   
                    }
                    echo "</p></div>";
                }
            }
 
        //end of first if
        //else part is for users who are not logged in
        }else{
            
            //if the user has not logged in and is at the homePage
            if($type == "public"){

                $whereClause = "";
                
                $endQuery = 0;
            
            //if the user has not logged in and is at the 'Search' section
            }else if($type == "isFollowing"){

                $endQuery = 1;
            
            //if the user has not logged in and is at the 'Your posts' section
            }else if($type == "yourPosts"){

                $endQuery = 1;
            
            //if the user wants to search for something
            }else if($type == "search"){
                
                echo '<p class="searchString">Showing results for "'.mysqli_real_escape_string($link, $_GET['query']).'"</p>';
                
                $whereClause = "WHERE post LIKE '%".mysqli_real_escape_string($link, $_GET['query'])."%' ";
                
                $endQuery = 0;
            
            //if the user wants to view posts of a particular user
            }else if (is_numeric($type)){
                
                $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $type)." LIMIT 1";

                $userQueryResult = mysqli_query($link, $userQuery);

                $user = mysqli_fetch_assoc($userQueryResult);
                
                echo "<h2 class='heading'>".mysqli_real_escape_string($link, $user['email'])."'s Posts</h2>";
                
                $whereClause = "WHERE userid = ".mysqli_real_escape_string($link, $type);
                
                $noPostsForThisUser = 1;
                
            }

            $query = "SELECT * FROM posts ".$whereClause." ORDER BY `datetime` DESC";

            $result = mysqli_query($link, $query);
            
            if($endQuery == 1){
                
                echo "<p class='display'>You need to login to view this page :)</p>";
                
            }else if(mysqli_num_rows($result) == 0){

                if($noPostsForThisUser == 1){
                    
                    echo "<p class='display'>No posts found from this user :(</p>";
                    
                }else{

                    echo "<p class='display'>There are no posts right now to show. Why don't you start post? :)</p>";
                
                }

            }else{
                
                while($row = mysqli_fetch_assoc($result)){

                    $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";

                    $userQueryResult = mysqli_query($link, $userQuery);

                    $user = mysqli_fetch_assoc($userQueryResult);

                    echo "<div class='post'><p><b><a href='?page=users&userid=".$user['id']."'>".$user['email']."</a></b> <span class='time'>".timeSince(time() - strtotime($row['datetime']))." ago </span></p>";

                    echo "<p><span class='postText'>".$row['post']."</span></p>";

                 

                }
            }
             
        }
        
    }

    //function for the search box
   
    function displaySearch(){
        
        echo '<form class="form-inline searchArea">
              <div class="form-group">
                <input type="hidden" name="page" value="search">
                <input type="text" name="query" class="form-control inputStyle" id="searchBox" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-primary">Search</button>
             </form>';
        
    }
    
    //function for the posts Box

    function displayPostBox(){
        
        if (isset($_SESSION['id'])) {
            
            if($_SESSION['id'] > 0){
                
                echo '<div id="postSuccess" class="alert alert-success">Posted successfully!</div>
                      
              <div class="form newPostArea">
              <div class="form-group">
                <textarea type="text" class="form-control inputStyle" id="postPost" placeholder="Enter your posts here...."></textarea>
              </div>
              <button type="submit" id="postPostButton" class="btn btn-primary">Post</button>
             </div>';
                
            }
            
        }
        
    }

    //function to display all the users on the 'user' page
    function displayUsers(){
        
        global $link;
        
        $query = "SELECT * FROM users";

        $result = mysqli_query($link, $query);

        if(mysqli_num_rows($result) == 0){

            echo "<p class='display'>Sorry, There are no users on our site. Would you like to be our first user :)</p>";

        }else{
            
            while($row = mysqli_fetch_assoc($result)){
                
                echo "<p class='display'><a href='?page=users&userid=".$row['id']."'>".$row['email']."</a></p>";
                
            }
        
        }
        
    }
    
?>
