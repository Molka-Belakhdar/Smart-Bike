<?php
// velos.php — Affiche tous les vélos de la base de données
require_once 'config.php';

$stmt = $pdo->query('SELECT * FROM velos ORDER BY date_ajout DESC');
$velos = $stmt->fetchAll();
?>
<?php include 'header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Nos Vélos</h1>
        <p>Découvrez notre gamme complète de vélos électriques</p>
    </div>

    <?php if (empty($velos)): ?>
        <p style="color:var(--muted);text-align:center;padding:60px 0;">Aucun vélo disponible.</p>
    <?php else: ?>
    <div class="velos-grid">
        <?php foreach ($velos as $velo): ?>
        <div class="velo-card">
            <!-- Photo -->
            <?php if (file_exists($velo['photo'])): ?>
                <img src="<?= htmlspecialchars($velo['photo']) ?>" alt="<?= htmlspecialchars($velo['nom']) ?>" class="velo-card-img">
            <?php else: ?>
                <div class="velo-card-img-placeholder">🚲</div>
            <?php endif; ?>

            <div class="velo-card-body">
                <div class="velo-card-name"><?= htmlspecialchars($velo['nom']) ?></div>
                <div class="velo-card-price"><?= number_format($velo['prix'], 2, ',', ' ') ?> €</div>
                <div class="velo-card-actions">
                    <a href="commander.php?id=<?= $velo['id'] ?>" class="btn btn-primary">Commander</a>
                    <a href="velo.php?id=<?= $velo['id'] ?>" class="btn btn-outline">Plus d'infos</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
