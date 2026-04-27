<?php
// index.php — Page d'accueil : affiche le dernier vélo ajouté
require_once 'config.php';

// Récupérer le dernier vélo ajouté (ORDER BY date_ajout DESC)
$stmt = $pdo->query('SELECT * FROM velos ORDER BY date_ajout DESC LIMIT 1');
$velo = $stmt->fetch();
?>
<?php include 'header.php'; ?>

<!-- HERO : dernier vélo ajouté -->
<?php if ($velo): ?>
<div class="hero">
    <!-- Texte -->
    <div class="hero-content">
        <span class="hero-badge">✦ Nouveauté</span>
        <h1>Le <span><?= htmlspecialchars($velo['nom']) ?></span> est arrivé.</h1>
        <p><?= htmlspecialchars(mb_substr($velo['description'], 0, 220)) ?>...</p>
        <div class="hero-price">
            <?= number_format($velo['prix'], 2, ',', ' ') ?> €
            <small> / prix de lancement</small>
        </div>
        <div style="display:flex;gap:14px;flex-wrap:wrap;">
            <a href="commander.php?id=<?= $velo['id'] ?>" class="btn btn-primary">Commander maintenant</a>
            <a href="velo.php?id=<?= $velo['id'] ?>" class="btn btn-outline">En savoir plus →</a>
        </div>
    </div>

    <!-- Image -->
    <div class="hero-img">
        <?php if (file_exists($velo['photo'])): ?>
            <img src="<?= htmlspecialchars($velo['photo']) ?>" alt="<?= htmlspecialchars($velo['nom']) ?>">
        <?php else: ?>
            <div class="hero-img-placeholder">
                <div class="bike-icon">🚲</div>
                <p><?= htmlspecialchars($velo['nom']) ?></p>
            </div>
        <?php endif; ?>
        <div class="hero-glow"></div>
    </div>
</div>

<!-- Section : Tous les modèles -->
<section style="background:var(--dark2);padding:80px 0;border-top:1px solid var(--gray);">
    <div class="container">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:40px;">
            <div>
                <h2 style="font-family:'Bebas Neue',sans-serif;font-size:42px;color:var(--white);">Nos Modèles</h2>
                <p style="color:var(--muted);">Trouvez le vélo qui vous correspond</p>
            </div>
            <a href="velos.php" class="btn btn-outline">Voir tous →</a>
        </div>

        <!-- Stats rapides -->
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:60px;">
            <div style="background:var(--dark3);border:1px solid var(--gray);border-radius:12px;padding:28px;text-align:center;">
                <div style="font-family:'Bebas Neue',sans-serif;font-size:48px;color:var(--green);">4</div>
                <div style="color:var(--muted);font-size:14px;margin-top:4px;">Modèles disponibles</div>
            </div>
            <div style="background:var(--dark3);border:1px solid var(--gray);border-radius:12px;padding:28px;text-align:center;">
                <div style="font-family:'Bebas Neue',sans-serif;font-size:48px;color:var(--green);">130km</div>
                <div style="color:var(--muted);font-size:14px;margin-top:4px;">Autonomie maximale</div>
            </div>
            <div style="background:var(--dark3);border:1px solid var(--gray);border-radius:12px;padding:28px;text-align:center;">
                <div style="font-family:'Bebas Neue',sans-serif;font-size:48px;color:var(--green);">2018</div>
                <div style="color:var(--muted);font-size:14px;margin-top:4px;">Année de fondation</div>
            </div>
        </div>

        <div style="text-align:center;">
            <a href="velos.php" class="btn btn-primary" style="font-size:16px;padding:16px 36px;">Découvrir tous nos vélos</a>
        </div>
    </div>
</section>

<?php else: ?>
<div class="container" style="padding:80px 0;text-align:center;">
    <p style="color:var(--muted);">Aucun vélo disponible pour le moment.</p>
</div>
<?php endif; ?>

<?php include 'footer.php'; ?>
