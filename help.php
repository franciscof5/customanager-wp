<?php
@include("header.php");
?>
 
	<?php
		@include("navbar.php");
		@include("php/Parsedown.php");
		$contents = file_get_contents('readme.md');
		$Parsedown = new Parsedown();
		echo $Parsedown->text($contents);
	?>

<?php
	@include("footer.php");
?>
  
