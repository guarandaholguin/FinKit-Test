<?php

require_once "Control/home_control.php";

require_once "Control/login_control.php";
require_once "Model/login_model.php";

require_once "Control/user_control.php";
require_once "Model/user_model.php";

require_once "vendor/autoload.php";

$home = new ControlHome();
$home ->ControlTraerHome();
