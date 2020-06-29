<div class="container-fluid backgroud"></div>
<div class="container-fluid homePage">
    <div class="row">
      <div class="col-md-8">
          <h2 class="heading" id="homeHeading">Your Posts</h2>
          <?php displayPosts('yourPosts'); ?>
      </div>
      <div class="col-md-4">
          <?php displaySearch(); ?>
          <br>
          <?php displayPostBox(); ?>
      </div>
    </div>
</div>