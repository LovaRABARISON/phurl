<?php
 if( !defined('PHURL' ) ) {
 header('HTTP/1.0 404 Not Found');
     exit();
 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php echo SITE_TITLE; ?> | <?php echo SITE_SLOGAN; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="<?php echo THEME_PATH; ?>style.css" />
	<script type="text/javascript" src="<?php echo THEME_PATH; ?>jquery.js"></script>
	<script type="text/javascript"> 
	var tourl;
	$(document).ready(function(){
		$("input#url").bind("textchange",showPage);
		$("input#url").bind("textchange",toggleButtons);
		$("input#url").focus();

			
		$("form#surlform").submit(function(){
			var url = $("input#url").val();	
			$.get("api/create.php?url=" + url, function(data) {
        			$("input#url").val(data);
        			$("input#url").select();
					$('#button').hide();
					$('#hbutton').show();
					tourl = data;
					$('#hbutton').bind('click', function() {
						window.location = tourl + "-";
					});
    			});

   			return false;
		});
    	});
	
	$(document).click(function(){
		showPage();
    });
	$(document).mousemove(function(){
		showPage();
    });
	function toggleButtons() {
		$('#hbutton').hide();
		$('#button').show();
	}
	function showPage() {
		$("#show-options").animate({ opacity: 1}, 2000);
		$("#header").animate({ opacity: 1}, 1000);
		$(".notice").animate({ opacity: 1}, 1000);
		$("#footer").animate({ opacity: 1}, 1000);
	}

</script>
<?php
$getalias = trim(mysql_real_escape_string($_SERVER['REQUEST_URI'], $mysql['connection']));
$alias = substr($getalias, 1, strlen($getalias));
$alias = str_replace("-","",$alias);
$jquery = <<<JQUERY
<script>
 $(document).ready(function() {
 	 $("#dynamicdiv").load("includes/dynstats.php?alias=$alias");
   var refreshId = setInterval(function() {
      $("#dynamicdiv").load('includes/dynstats.php?alias=$alias');
   }, 9000);
   $.ajaxSetup({ cache: false });
});
</script>
JQUERY;
echo $jquery;
?>

</head>
<body>
<div id="container">
 <div id="header">
 	<div id="logo"><h1><?php echo SITE_TITLE; ?></h1></div>
 	<span id="slogan">- <?php echo SITE_SLOGAN; ?></span>
 	<div id="menu">
 		<ul>
 			<li><a href="/">Home</a></li>
<li><a href="/api/create.php?url=http://example.org/">API</a></li>

 		</ul>
 	</div>
 	<div class="clear"></div>
 	
 </div>
<div id="content">
