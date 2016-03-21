<?php
$view = '<html>
	<head>
		<!-- SITE HEADER START-->
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
		<meta http-equiv="Content-Script-Type" content="text/javascript">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>%s</title>
		<script>var APP_URL = "' . APP_URL . '";</script>
		<!-- END -->
		
		<!-- JQUERY -->
		<!--<link rel="stylesheet" href="jquery/jquery-ui.css">-->
		<script src="' . APP_URL . '/view/jquery/jquery-2.1.4.js" ></script>
		<script src="' . APP_URL . '/view/chosen/chosen.jquery.js" ></script>
		<script src="' . APP_URL . '/view/jquery-ui/jquery-ui.js" defer></script>
		<link rel="stylesheet" href="' . APP_URL . '/view/jquery-ui/jquery-ui.theme.css" />
		<link rel="stylesheet" href="' . APP_URL . '/view/jquery-ui/jquery-ui.structure.css" />
		<link rel="stylesheet" href="' . APP_URL . '/view/chosen/chosen.min.css" />
		
		
		<!-- BOOSTRAP -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="' . APP_URL . '/view/bootstrap/css/bootstrap.css" />

		<!-- Optional theme -->
		<link rel="stylesheet" href="' . APP_URL . '/view/bootstrap/css/bootstrap-theme.css" />

		<!-- Latest compiled and minified JavaScript -->
		<script src="' . APP_URL . '/view/bootstrap/js/bootstrap.min.js" defer></script>
		<!-- END -->
		
		<!-- Extra scripts -->
		<script src="' . APP_URL . '/view/string.format/string.format-1.0.js" defer></script>
		<script src="' . APP_URL . '/view/scripts/utils.js" defer></script>
			%s
		<!-- END -->
		
		<!-- SITE -->
		%s
		<script>
		</script>
		<link rel="stylesheet" href="'. APP_URL. '/view/style.css" />
		<!-- SITE HEADER END -->
	</head>
	<body>
		<div align="center">
		%s
		</div>
	</body>
</html>';
$footer = "";

$content = "";

function Add($data)
{
	global $content;
	
	$content .= $data;
}

function Show($data, $script = "", $title = "audiotest", $disable_view = false)
{
	global $view;
	$script_url = GetScriptUrl($script);
	
	if($script == "")
		$output = sprintf($view, $title, $script, "", $data);
	else
		$output = sprintf($view, $title, $script_url, "", $data);
	
	return print($output);
	
}

function GetScriptUrl($name)
{
	$script = '<script src="'. APP_URL . '/view/scripts/' . $name . '.js" defer></script>';
	return $script;
}