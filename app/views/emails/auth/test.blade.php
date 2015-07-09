<html>
<head>
	<style>
	body{
		width:600px;
		margin:0px;
		padding:0px;
		font-family: cursive;

	}
	#header{
		min-height:80px;
		padding:2px 5px 2px 5px;
		background-color:#1abc9c;
		color:white;
	}

	#footer{

		min-height:50px;
		padding:2px 5px 2px 5px;
		background-color:#1abc9c;
		color:white;

	}

	.content{
		min-height:400px;
		padding:2px;

	}
	</style>
</head>
<body>
	<div id="header">
		<h2>Mycollegeadd Inc.</h2>
	</div>
	<div class="content">
		Hello {{ $username }},<br><br>

		<p>Please activate your account using the following link.</p>

		---<br>
		{{ $link }}

		---<br>
	</div>
	<div id="footer">
		Regards Mycollegeadd Inc.
	</div>
</body>
</html>