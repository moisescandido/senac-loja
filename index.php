<?php
session_start();

if (!$_SESSION['nome']) {
    header("Location: ./views/login.php");
} else {
    echo "Nome:" . $_SESSION['nome'];
}
?>