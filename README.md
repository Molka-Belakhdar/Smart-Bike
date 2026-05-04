# Smartbike — Guide d'installation sur WAMP

## Structure des fichiers

```
smartbike/
├── config.php          ← Connexion base de données
├── header.php          ← En-tête (logo + menu)
├── footer.php          ← Pied de page
├── style.css           ← Tous les styles
├── index.php           ← Page d'accueil (dernier vélo)
├── velos.php           ← Liste de tous les vélos
├── velo.php            ← Détail d'un vélo
├── commander.php       ← Formulaire de commande
├── contact.php         ← Page de contact + carte
├── smartbike.sql       ← Base de données
├── img/                ← Dossier pour les photos des vélos
│   ├── bikeone.jpg
│   ├── bike22.jpg
│   ├── bikefirst.jpg
│   └── bike5.jpg
└── README.md
```

---

## Étape 1 — Installer WAMP

1. Télécharger WAMP depuis [wampserver.com](https://www.wampserver.com/)
2. Installer et lancer WAMP
3. L'icône dans la barre des tâches doit devenir **verte** ✅

---

## Étape 2 — Copier les fichiers

1. Ouvrez le dossier WAMP : `C:\wamp64\www\`
2. Créez un nouveau dossier : `C:\wamp64\www\smartbike\`
3. Copiez **tous les fichiers** du projet dans ce dossier

---

## Étape 3 — Créer la base de données

### Méthode A — Via phpMyAdmin (recommandé)
1. Ouvrez votre navigateur → [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Cliquez sur **"Importer"** dans le menu du haut
3. Cliquez sur **"Choisir un fichier"** → sélectionnez `smartbike.sql`
4. Cliquez sur **"Importer"** en bas de page

### Méthode B — Manuellement
1. Dans phpMyAdmin, cliquez sur **"SQL"**
2. Copiez-collez le contenu de `smartbike.sql`
3. Cliquez **"Exécuter"**

---

## tape 4 — Vérifier la configuration

Ouvrez `config.php` et vérifiez :
```php
define('DB_HOST', 'localhost');   // Ne pas changer
define('DB_NAME', 'smartbike');   // Nom de la base créée
define('DB_USER', 'root');        // Utilisateur WAMP par défaut
define('DB_PASS', '');            // Mot de passe vide par défaut
```

---

## Étape 5 — Ajouter les images (optionnel)

1. Créez un dossier `img/` dans `C:\wamp64\www\smartbike\`
2. Ajoutez vos photos nommées : `bikeone.jpg`, `bike22.jpg`, `bikefirst.jpg`, `bike5.jpg`
   - Si aucune image n'est trouvée, une icône 🚲 s'affiche automatiquement

---

## Étape 6 — Lancer le site

Ouvrez votre navigateur et allez sur :
```
http://localhost/smartbike/
```

---

## Pages disponibles

| URL | Description |
|-----|-------------|
| `http://localhost/smartbike/` | Page d'accueil |
| `http://localhost/smartbike/velos.php` | Liste des vélos |
| `http://localhost/smartbike/velo.php?id=1` | Détail d'un vélo |
| `http://localhost/smartbike/commander.php` | Formulaire de commande |
| `http://localhost/smartbike/contact.php` | Page de contact |

---

## Problèmes courants

**Erreur de connexion DB** → Vérifiez que WAMP est bien démarré (icône verte) et que la base `smartbike` a été créée.

**Page blanche** → Activez l'affichage des erreurs PHP dans WAMP (clic droit icône → PHP → Error reporting → All).

**Images non affichées** → Normal si vous n'avez pas encore ajouté les fichiers dans le dossier `img/`.
