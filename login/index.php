<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
?>

<h2>Selamat Datang, <?= htmlspecialchars($_SESSION['nama']) ?></h2>

<p>Username: <?= htmlspecialchars($_SESSION['username']) ?></p>

<a href="logout.php">Logout</a>