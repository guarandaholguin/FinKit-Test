<?
session_start();
?>
<!DOCTYPE html>
<head>
	    <meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
</head>
<html lang="ru">
	<body>
        <!--PHP-->
        <?php 
        	if(isset($_GET["page"])){
        		if($_GET["page"]=="main" || 
					$_GET["page"]=="login"||
					$_GET["page"]=="user"|| 
					$_GET["page"]=="close"){
						include "pages/".$_GET["page"].".php";
        		}else{
        			include "pages/error.php";
        		}	
        	}else{
        		include "pages/main.php";
        	}
        	?>
        <!--End-->
	</body>
</html>
