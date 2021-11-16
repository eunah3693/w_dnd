<?php
session_cache_expire(3600);
session_start();
print_r($_SESSION);
echo session_cache_expire();
?>
