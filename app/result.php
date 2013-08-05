<?php
require_once('../Pathfinder.php');

$path = Pathfinder::findPath($_GET['origin'], $_GET['destination']);

$tam = sizeof($path);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <!-- JavaScript plugins (requires jQuery) -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<title>Pathfinder - Results</title>
</head>
<body>
<div class="container">
	<h2> Results </h2>
	<p>&nbsp;</p>
	<?php if ($path === false): ?>
		<span class="alert alert-danger">Path not found!</span>
	<?php else: ?>
		<h3> Path </h3>
		<?php foreach ($path as $key => $currentPath): ?>
			<?php echo $currentPath->getValue();?>
			<?php if ($key < ($tam-1)): ?>
				<?php echo "<strong>=></strong>";?> 
			<?php endif; ?>
		<?php endforeach ?>
	<?php endif; ?>
</div>
</body>
</html>