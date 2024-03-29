<?php
  require "header2.php";
  include "functions/display.func.php";

 // display_all_photos($_SESSION['id']);
  session_start();
?>
<main class="hero is-fullheight has-background-dark">
<div class='columns'>
<div class='container profile'>

<div class='section profile-heading'>
  <div class='columns is-mobile is-multiline'>
    <div class='column is-2'>
      <span class='header-icon user-profile-image'>
	  <figure class= "image is-128x128">
        <img class="is-rounded" src=<?php echo "data:image/png;base64,".base64_encode($_SESSION['pic']) ?>>
	  </figure>
      </span>
    </div>
    <div class='column is-4-tablet is-10-mobile name'>
        <a class='button is-danger is-outlined' href='changepass.php' style='margin: 5px'>
          Edit Password
        </a>
        <a class='button is-danger is-outlined' href='changeDetails.php' style='margin: 5px'>
          Edit Profile
        </a>
		<br>
		<strong class='has-text-white is-size-1'><?php echo $_SESSION['username'] ?></strong>
    </div>
  </div>
</div>
</div>
</div>
<!-- <div class="container has-text-centered"> -->
      <div class="box is-7 is-large has-background-dark" style="margin-top: 5px;">
        <div class="container is-large">
          <?php display_all_photos($_SESSION['id'],null, "640px", "480px"); ?>
        </div>
	  </div>
<!-- </div> -->
</main>
