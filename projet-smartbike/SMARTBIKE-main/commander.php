<?php
// commander.php — Formulaire de commande
require_once 'config.php';

// Récupérer tous les vélos pour le menu déroulant
$stmt = $pdo->query('SELECT id, nom, prix FROM velos ORDER BY nom');
$velos = $stmt->fetchAll();

// ID pré-sélectionné si on vient de velo.php
$preselect = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;

$success = false;
$errors  = [];

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $velo_id = isset($_POST['velo_id']) && is_numeric($_POST['velo_id']) ? (int)$_POST['velo_id'] : null;
    $nom     = trim($_POST['nom']    ?? '');
    $prenom  = trim($_POST['prenom'] ?? '');
    $email   = trim($_POST['email']  ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validation
    if (!$velo_id)          $errors[] = 'Veuillez sélectionner un vélo.';
    if (empty($nom))        $errors[] = 'Le nom est obligatoire.';
    if (empty($prenom))     $errors[] = 'Le prénom est obligatoire.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'L\'adresse email est invalide.';

    if (empty($errors)) {
        $insert = $pdo->prepare(
            'INSERT INTO commandes (velo_id, nom, prenom, email, message) VALUES (?, ?, ?, ?, ?)'
        );
        $insert->execute([$velo_id, $nom, $prenom, $email, $message]);
        $success = true;
    }
}
?>
<?php include 'header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Commander</h1>
        <p>Remplissez le formulaire ci-dessous pour passer votre commande</p>
    </div>

    <div class="form-section">
        <?php if ($success): ?>
            <div class="alert alert-success">
                ✅ Votre commande a bien été enregistrée ! Nous vous contacterons sous 48h.
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <?php foreach ($errors as $e): ?>
                    <div>⚠ <?= htmlspecialchars($e) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="commander.php">
            <!-- Sélection du vélo -->
            <div class="form-group">
                <label for="velo_id">Vélo souhaité *</label>
                <select name="velo_id" id="velo_id" required>
                    <option value="">— Choisissez un vélo —</option>
                    <?php foreach ($velos as $v): ?>
                        <option value="<?= $v['id'] ?>"
                            <?= ($preselect === $v['id'] || (isset($_POST['velo_id']) && $_POST['velo_id'] == $v['id'])) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($v['nom']) ?> — <?= number_format($v['prix'], 2, ',', ' ') ?> €
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Nom / Prénom -->
            <div class="form-row">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" name="nom" id="nom" placeholder="Dupont"
                           value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" name="prenom" id="prenom" placeholder="Jean"
                           value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" required>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Adresse email *</label>
                <input type="email" name="email" id="email" placeholder="jean.dupont@email.com"
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            </div>

            <!-- Message -->
            <div class="form-group">
                <label for="message">Message (optionnel)</label>
                <textarea name="message" id="message" placeholder="Précisez vos souhaits (couleur, options, délai de livraison...)..."><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
            </div>

            <div class="form-submit">
                <button type="submit" class="btn btn-primary" style="padding:14px 36px;font-size:15px;">
                    Envoyer ma commande →
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
