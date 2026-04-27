-- Base de données Smartbike
CREATE DATABASE IF NOT EXISTS smartbike CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE smartbike;

-- Table des vélos
CREATE TABLE IF NOT EXISTS velos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    photo VARCHAR(255) NOT NULL,
    date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table des commandes
CREATE TABLE IF NOT EXISTS commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    velo_id INT NOT NULL,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT,
    date_commande DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (velo_id) REFERENCES velos(id)
);

-- Table des contacts
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    date_contact DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Données de test
INSERT INTO velos (nom, description, prix, photo, date_ajout) VALUES
('BikeOne', 'Le BikeOne est notre modèle d\'entrée de gamme, idéal pour les débutants. Léger et maniable, il offre une autonomie de 40 km avec sa batterie lithium de 250 Wh. Parfait pour les trajets urbains quotidiens, il dispose d\'un moteur arrière de 250W et d\'un système de freinage hydraulique de haute qualité.', 1299.99, 'img/bikeone.jpg', '2024-01-15 10:00:00'),
('Bike22', 'Le Bike22 représente l\'équilibre parfait entre performance et confort. Avec son moteur central de 350W et sa batterie de 400 Wh, il vous offre une autonomie de 70 km. Son cadre en aluminium renforcé et ses suspensions avant absorbent les chocs pour un confort optimal sur tous les terrains.', 1899.99, 'img/bike22.jpg', '2024-06-20 14:30:00'),
('BikeFirst', 'Le BikeFirst est notre modèle premium, conçu pour les cyclistes exigeants. Son moteur de 500W associé à une batterie 500 Wh lui confère une autonomie de 100 km. L\'écran LCD intégré affiche vitesse, distance et autonomie en temps réel. Livré avec un chargeur rapide 4A.', 2599.99, 'img/bikefirst.jpg', '2024-11-10 09:00:00'),
('Bike5', 'Le Bike5 est notre toute dernière innovation ! Ce vélo électrique révolutionnaire est équipé d\'un moteur de 750W et d\'une batterie longue durée de 630 Wh pour une autonomie exceptionnelle de 130 km. Grâce à sa connectivité Bluetooth et son application mobile dédiée, vous pouvez personnaliser chaque paramètre de conduite. Design futuriste, cadre carbone ultra-léger et assistance intelligente qui s\'adapte automatiquement à votre effort.', 3499.99, 'img/bike5.jpg', '2025-01-05 08:00:00');
