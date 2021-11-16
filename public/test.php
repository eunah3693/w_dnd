<?php
ini_set("session.cache_expire", 3600);
session_start();
$_SESSION['kcp_auth'] = sprintf('%06d',rand(000000,999999));
?>
