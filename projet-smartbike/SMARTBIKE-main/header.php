<?php
// header.php — En-tête commun à toutes les pages
// Récupérer le nom du fichier courant pour activer le bon lien de navigation
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smartbike — Vélos Électriques</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
</head>
<body>

<header>
    <div class="header-inner">
        <!-- Logo -->
        <a href="index.php" class="logo">
            <div class="logo-icon">⚡</div>
            Smart<span>bike</span>
        </a>

        <!-- Navigation -->
        <nav id="main-nav">
            <a href="index.php" class="<?= $current === 'index.php' ? 'active' : '' ?>">Accueil</a>
            <a href="velos.php" class="<?= $current === 'velos.php' || $current === 'velo.php' ? 'active' : '' ?>">Vélos</a>
            <a href="contact.php" class="<?= $current === 'contact.php' ? 'active' : '' ?>">Contact</a>
            <a href="commander.php" class="nav-cta">Commander</a>
        </nav>

        <!-- Hamburger (mobile) -->
        <div class="hamburger" id="hamburger" onclick="toggleNav()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>

<main>

<script>
function toggleNav() {
    document.getElementById('main-nav').classList.toggle('open');
}
</script>
