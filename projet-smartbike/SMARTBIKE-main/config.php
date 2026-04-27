<?php
// config.php — Connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'smartbike');
define('DB_USER', 'root');      // Utilisateur WAMP par défaut
define('DB_PASS', '');          // Mot de passe WAMP par défaut (vide)
define('DB_CHARSET', 'utf8mb4');

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('<div style="padding:20px;background:#ff4444;color:white;font-family:sans-serif;">
        <h2>Erreur de connexion à la base de données</h2>
        <p>' . htmlspecialchars($e->getMessage()) . '</p>
        <p>Vérifiez que WAMP est démarré et que la base de données <strong>smartbike</strong> existe.</p>
    </div>');
}
?>
