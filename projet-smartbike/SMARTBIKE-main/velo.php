<?php
// velo.php — Page détaillée d'un vélo
require_once 'config.php';

// Vérifier que l'id est fourni et valide
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: velos.php');
    exit;
}

$id = (int) $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM velos WHERE id = ?');
$stmt->execute([$id]);
$velo = $stmt->fetch();

if (!$velo) {
    header('Location: velos.php');
    exit;
}
?>
<?php include 'header.php'; ?>

<div class="container" style="padding-top:60px;">
    <!-- Fil d'Ariane -->
    <nav style="font-size:13px;color:var(--muted);margin-bottom:40px;">
        <a href="index.php" style="color:var(--muted);">Accueil</a>
        <span style="margin:0 8px;">/</span>
        <a href="velos.php" style="color:var(--muted);">Vélos</a>
        <span style="margin:0 8px;">/</span>
        <span style="color:var(--white);"><?= htmlspecialchars($velo['nom']) ?></span>
    </nav>

    <div class="velo-detail">
        <!-- Galerie photos -->
        <div class="velo-detail-gallery">
            <?php if (file_exists($velo['photo'])): ?>
                <img src="<?= htmlspecialchars($velo['photo']) ?>" alt="<?= htmlspecialchars($velo['nom']) ?>">
            <?php else: ?>
                <div class="img-placeholder">🚲</div>
            <?php endif; ?>

            <!-- Photo secondaire (même image pour la démo) -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:12px;">
                <div style="height:120px;background:var(--dark3);border-radius:8px;border:1px solid var(--gray);display:flex;align-items:center;justify-content:center;font-size:30px;opacity:0.4;">🚲</div>
                <div style="height:120px;background:var(--dark3);border-radius:8px;border:1px solid var(--gray);display:flex;align-items:center;justify-content:center;font-size:30px;opacity:0.4;">⚡</div>
            </div>
        </div>

        <!-- Infos -->
        <div class="velo-detail-info">
            <div style="display:inline-block;background:rgba(57,255,20,0.15);color:var(--green);border:1px solid rgba(57,255,20,0.3);padding:5px 12px;border-radius:20px;font-size:11px;font-weight:600;letter-spacing:1px;text-transform:uppercase;margin-bottom:16px;">
                Vélo Électrique
            </div>
            <h1><?= htmlspecialchars($velo['nom']) ?></h1>
            <div class="velo-detail-price"><?= number_format($velo['prix'], 2, ',', ' ') ?> €</div>

            <p class="velo-detail-desc"><?= nl2br(htmlspecialchars($velo['description'])) ?></p>

            <!-- Caractéristiques fictives -->
            <div style="background:var(--dark2);border:1px solid var(--gray);border-radius:10px;padding:20px;margin-bottom:28px;">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                    <div style="font-size:13px;color:var(--muted);">Moteur <strong style="color:var(--white);display:block;">250W – 750W</strong></div>
                    <div style="font-size:13px;color:var(--muted);">Autonomie <strong style="color:var(--white);display:block;">40 – 130 km</strong></div>
                    <div style="font-size:13px;color:var(--muted);">Batterie <strong style="color:var(--white);display:block;">Lithium-ion</strong></div>
                    <div style="font-size:13px;color:var(--muted);">Garantie <strong style="color:var(--white);display:block;">2 ans</strong></div>
                </div>
            </div>

            <a href="commander.php?id=<?= $velo['id'] ?>" class="btn btn-primary" style="width:100%;justify-content:center;font-size:16px;padding:16px;">
                Commander ce vélo →
            </a>
            <a href="velos.php" class="btn btn-outline" style="width:100%;justify-content:center;margin-top:12px;">
                ← Retour aux vélos
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
