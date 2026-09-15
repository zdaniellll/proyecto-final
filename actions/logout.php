<?php
require_once __DIR__ . '/../includes/config.php';
session_unset();
session_destroy();
header('Location: ' . app_url('login.php'));
exit();
?>