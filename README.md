# Procédure d'installation

## Prérequis
* Remplir le .env avec les informations de connexion à la base de données
* Avoir composer installé sur la machine
* Avoir npm installé sur la machine
* Avoir symfony installé sur la machine
* Avoir un serveur de base de données (MySQL, MariaDB, PostgreSQL, etc.)

## Commandes à exécuter

Installer les dépendances
```bash
composer install
npm i
```

Créer la structure de la base de données
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

Lancer le serveur
```bash
symfony server:ca:install
symfony server:start
```