<?php
session_start();
$_SESSION['test'] = 'Hello Session';
echo $_SESSION['test'];
?>
