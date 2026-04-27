<?php
// contact.php — Page de contact
require_once 'config.php';

$success = false;
$errors  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom     = trim($_POST['nom']    ?? '');
    $prenom  = trim($_POST['prenom'] ?? '');
    $email   = trim($_POST['email']  ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($nom))        $errors[] = 'Le nom est obligatoire.';
    if (empty($prenom))     $errors[] = 'Le prénom est obligatoire.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'L\'adresse email est invalide.';
    if (empty($message))    $errors[] = 'Le message est obligatoire.';

    if (empty($errors)) {
        $insert = $pdo->prepare(
            'INSERT INTO contacts (nom, prenom, email, message) VALUES (?, ?, ?, ?)'
        );
        $insert->execute([$nom, $prenom, $email, $message]);
        $success = true;
    }
}
?>
<?php include 'header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Contact</h1>
        <p>Une question ? Nous sommes là pour vous répondre.</p>
    </div>

    <div class="contact-layout">
        <!-- Formulaire -->
        <div>
            <h2 style="font-family:'Bebas Neue',sans-serif;font-size:28px;color:var(--white);margin-bottom:24px;">Envoyez-nous un message</h2>

            <?php if ($success): ?>
                <div class="alert alert-success">
                    ✅ Votre message a été envoyé avec succès ! Nous vous répondrons sous 24h.
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <?php foreach ($errors as $e): ?>
                        <div>⚠ <?= htmlspecialchars($e) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="contact.php">
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

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" name="email" id="email" placeholder="jean.dupont@email.com"
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea name="message" id="message" placeholder="Votre message..." required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="padding:14px 36px;">
                    Envoyer →
                </button>
            </form>
        </div>

        <!-- Informations & Carte -->
        <div>
            <div class="contact-info">
                <h2>Smartbike — Nos coordonnées</h2>

                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <div class="contact-item-text">
                        <strong>Adresse</strong>
                        <span>34 Rue du Général Leclerc<br>92130 Issy-les-Moulineaux, France</span>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">📞</div>
                    <div class="contact-item-text">
                        <strong>Téléphone</strong>
                        <span>+33 1 23 45 67 89</span>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">✉️</div>
                    <div class="contact-item-text">
                        <strong>Email</strong>
                        <span>contact@smartbike.fr</span>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">🕐</div>
                    <div class="contact-item-text">
                        <strong>Horaires</strong>
                        <span>Lun – Ven : 9h00 – 18h00<br>Sam : 10h00 – 16h00</span>
                    </div>
                </div>
            </div>

            <!-- Google Maps — École EPSI Issy-les-Moulineaux -->
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.4!2d2.2737!3d48.8226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e670c0b527c3b1%3A0x5d4d6f43f8e27e9!2s34%20Rue%20du%20G%C3%A9n%C3%A9ral%20Leclerc%2C%2092130%20Issy-les-Moulineaux!5e0!3m2!1sfr!2sfr!4v1700000000000"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Localisation Smartbike">
                </iframe>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
