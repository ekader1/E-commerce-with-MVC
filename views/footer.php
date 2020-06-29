    <footer class="footer">
        <div class="container">
            <p>&copy; Yusuf Okutan & Erdem Kader  </p>
        </div>
    </footer>


<!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="loginModalLabel">Log in</h4>
          </div>
          <div class="modal-body">
              
            <form>
              <input type="hidden" id="loginActive" name="loginActive" value="1">    
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email address">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="toggleLogin">Sign up</button>
              or
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="loginOrSignup">Log in</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title modalDeleteHeading" id="exampleModalLabel">Delete Message</h5>
          </div>
          <div class="modal-body modalDeleteText" id="modalText">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="refreshAfterDelete">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script>
        $('#toggleLogin').click(function(){
           
            if($('#loginActive').val() === "1"){
                $('#loginActive').val("0");
                $('#loginModalLabel').html("Sign up");
                $('#loginOrSignup').html("Sign up");
                $('#toggleLogin').html("Log in");
            }else{
                $('#loginActive').val("1");
                $('#loginModalLabel').html("Log in");
                $('#loginOrSignup').html("Log in");
                $('#toggleLogin').html("Sign up");     
            }        
        });
        
        $('#loginOrSignup').click(function(){
            $.ajax({
                type: "POST",
                url: "actions.php?actions=loginSignup",
                data:"email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),
                success: function(result){
                    if(result == "1"){
                        window.location.assign("http://localhost:8080/reversetrade/");
                    }else{
                        $('#alert').html(result).show();
                    }
                }
            });
        });
        
        
        $(window).scroll(function() {
          if ($(document).scrollTop() > 50) {
            $('nav').addClass('shrink');
          } else {
            $('nav').removeClass('shrink');
          }
        });
        
        
        window.onload = function(){
            var heading = document.getElementById("homeHeading");
            var headingNumber = 5;
            if(heading.innerHTML === "Recent Posts"){
                headingNumber = 0;
            }
            if(heading.innerHTML === "Posts for You"){
                headingNumber = 1;
            }
            if(heading.innerHTML === "Your Posts"){
                headingNumber = 2;
            }
            if(heading.innerHTML === "Search Results"){
                headingNumber = 3;
            }
            if(heading.innerHTML === "Users"){
                headingNumber = 4;
            }
            var count = 0;
            if(headingNumber != 5){
                setInterval(function(){
                    if(count == 4){
                        if(headingNumber == 0)
                            heading.innerHTML = "Recent Posts";
                        if(headingNumber == 1)
                            heading.innerHTML = "Post for You";
                        if(headingNumber == 2)
                            heading.innerHTML = "Your Posts";
                        if(headingNumber == 3)
                            heading.innerHTML = "Search Results";
                        if(headingNumber == 4)
                            heading.innerHTML = "Users";
                        count = 0;
                    }else{
                        heading.innerHTML += ".";
                        count++;
                    }
                },1000);
            }
        };
        
        $(".toggleFollow").click(function(){
            
            var id = $(this).attr("data-userId");
            
            //alert(id);
            
            $.ajax({
                type: "POST",
                url: "actions.php?actions=toggleFollow",
                data:"userId=" + id,
                success: function(result){
                    if(result == "1"){
                        $("button[data-userId='" + id +"']").html("Follow");
                    }else if(result == "2"){
                        $("button[data-userId='" + id +"']").html("UnFollow");
                    }
                }
            });
        });
        
        $("#postPostButton").click(function(){
            
            $.ajax({
                type: "POST",
                url: "actions.php?actions=postPost",
                data:"postPost=" + $("#postPost").val(),
                success: function(result){
                    if(result == "1"){
                        $("#postSuccess").show();
                        $("#postFailure").hide();
                        location.reload();
                    }else if(result != "1"){
                        $("#postFailure").html(result).show();
                        $("#postSuccess").hide();
                    }
                }
            });
            
        });
        
        $(".deleteButton").click(function(){
            
            var id = $(this).attr("data-id");
            
            //alert(id);
            
            $.ajax({
                type: "POST",
                url: "actions.php?actions=deletePost",
                data:"id=" + id,
                success: function(result){
                    if(result == "1"){
                        $("#modalText").html("Delete was Successful");
                    }else{
                        $("#modalText").html("Delete was not Successful");
                    }
                }
            });
            
        });
        
        $("#refreshAfterDelete").click(function(){
            
            location.reload();
            
        });
        
    </script>

  </body>
</html>