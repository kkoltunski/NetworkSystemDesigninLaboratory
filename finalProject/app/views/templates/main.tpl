<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Klaudiusz Kołtuński">

	<link rel="shortcut icon" href="{$conf->projectDir}/assets/images/gt_favicon.png">

	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="{$conf->projectDir}/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="{$conf->projectDir}/assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="{$conf->projectDir}/assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="{$conf->projectDir}/assets/css/main.css">
</head>

<body class="home">
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom">
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
						class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			</div>
			{include file='navigationBar.tpl'}

			<!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->

	<!-- Header -->
	<header id="head">
		<h1 class="lead">{$page_title|default:"Tytuł domyślny"}</h1>
	</header>
	<!-- /Header -->

	<div class="jumbotron top-space">
		<div id="app_content" class="container">
		{include file='messages.tpl'}
			{block name=content} Domyślna treść zawartości .... {/block}
		</div>
	</div>

	{include file='footer.tpl'}

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="{$conf->projectDir}/assets/js/headroom.min.js"></script>
	<script src="{$conf->projectDir}/assets/js/jQuery.headroom.min.js"></script>
	<script src="{$conf->projectDir}/assets/js/template.js"></script>
</body>

</html>