<div class="container-fluid backgroud"></div>
<div class="container-fluid homePage">
    <div class="row">
      <div class="col-md-8">
          <h2 class="heading" id="homeHeading">Search Results</h2>
          <?php displayPosts('search'); ?>
      </div>
      <div class="col-md-4">
          <?php displaySearch(); ?>
          <?php displayPostBox(); ?>
      </div>
    </div>
</div>