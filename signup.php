<?php
	require "header4.php";
	// if (isset($_GET['error'])){
	// 	echo "<script>alert('".$_GET['error']."')</script>";
	// }

?>
<main class="hero is-fullheight has-background-dark">
	<div class="container has-text-centered ">
		<div class="box is-7 is-large has-background-grey-lighter "style="margin-top: 250px;">
			<div class="container is-large">
			<form action="functions/signup.func.php" method="post">
				<div class="field">
				<label class="label">Username</label>
					<div class="control has-icons-left has-icons-right">
						<input class="input" name="username" type="text" placeholder="Username" <?php if(isset($_GET['uid'])){echo "value=".$_GET['uid'];} ?>>
						<span class="icon is-small is-left">
							<i class="fas fa-user"></i>
						</span>
						<!-- <span class="icon is-small is-right">
							<i class="fas fa-check"></i>
						</span> -->
					</div>
					<!-- <p class="help is-success">This username is available</p> -->
				</div>

				<div class="field">
				<label class="label">Email</label>
					<div class="control has-icons-left has-icons-right">
						<input class="input" name="email" type="email" placeholder="Email Address" <?php if(isset($_GET['mail'])){echo "value=".$_GET['mail'];} ?>>
						<span class="icon is-small is-left">
							<i class="fas fa-envelope"></i>
						</span>
						<!-- <span class="icon is-small is-right">
							<i class="fas fa-exclamation-triangle"></i>
						</span> -->
					</div>
					<!-- <p class="help is-danger">This email is invalid</p> -->
				</div>
				<div class="field">
				<label class="label">Password</label>
  					<p class="control has-icons-left">
    					<input class="input" name="passwd" type="password" placeholder="Password">
    					<span class="icon is-small is-left">
      						<i class="fas fa-lock"></i>
    					</span>
  					</p>
				</div>
				<div class="field">
  					<p class="control has-icons-left">
    					<input class="input" name="passwd-repeat" type="password" placeholder="Re-enter Password">
    					<span class="icon is-small is-left">
      						<i class="fas fa-lock"></i>
    					</span>
  					</p>
				</div>

				<div class="field">
					<div class="control">
						<label class="checkbox">
						<input type="checkbox" name="tos">
							I agree to the <a href="tos.php">terms and conditions</a>
						</label>
					</div>
				</div>

				<div class="field is-grouped">
					<div class="control">
						<button type="submit" name="signup-submit" class="button is-danger">Submit</button>
					</div>
				<div class="control">
						<button name="signup-cancel" class="button is-danger is-light">Cancel</button>
				</div>
			</div>
			</form>
	</div>
</main>

<?php
  require "footer.php";
?>
