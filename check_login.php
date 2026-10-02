<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: /assessment_beginner/login.php");
  exit;
}
?>