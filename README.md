# Procédure d'installation

## Prérequis
* Remplir le .env avec les informations de connexion à la base de données
* Avoir composer installé sur la machine
* Avoir php installé sur la machine
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
yarn encore production
```

Lancer le serveur
```bash
symfony server:ca:install
symfony server:start -d
```

Le site web est alors accessible à l'adresse https://127.0.0.1:8000

## Réponses aux questions

1. Explication du test de charge
2. Explication choix technologique  
J'ai fais le choix d'utiliser Symfony pour ce projet car c'est un framework auquel je suis habitué et qui me permet de sortir rapidement une interface sécurisée. De part la contrainte de temps et le fait que je sois seul sur l'exercice, j'ai préféré partir sur une technologie me permettant de coder les bases du projet en un rien de temps.
3. Explication résultats

* register.cy.js : Test la création de compte + déconnexion et le fait qu'on ne puisse pas retourner sur le dashboard
* 

```bash
symfony server:stop
```