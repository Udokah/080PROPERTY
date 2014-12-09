<?php
session_start();
require_once("engine/fn/fn.php");
Unset_Login_Params() ;
header("location: ./login");
?>