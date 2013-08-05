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
	<title>Pathfinder</title>
</head>
<body>
	<div class="container">
		<h2> Web Pathfinder </h2>
		<form name="frmLinks" method="get" action="result.php">
			<label to="origin"> From: </label>
			<input type="text" name="origin" />
			<label to="destination"> To: </label>
			<input type="text" name="destination" />
			<input type="submit" value="Find Path" />
		</form>
	</div>
</body>
</html>