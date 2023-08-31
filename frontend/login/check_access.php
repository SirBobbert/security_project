<?php
session_start();

function checkAccess($requiredRole) {
    if ($_SESSION['user_role'] !== $requiredRole) {
        header("Location: http://localhost/demo/login");
        exit();
    }
}
?>
