# Résultats du Baccalauréat -  Université de Mahajanga

Ce projet permet de rechercher les résultats du baccalauréat en utilisant Laravel pour le backend et HTML/JavaScript pour le frontend.

## Fonctionnalités

- Recherche par matricule
- Recherche par nom
- Affichage des résultats avec pagination
- Affichage des messages d'alerte pour les candidats admis et non admis

## Prérequis

- PHP >= 8.3
- Composer
- Node.js et npm
- Serveur web (Apache, Nginx, etc.)
- Base de données (MySQL, PostgreSQL, etc.)

## Installation

1. Clonez le dépôt GitHub :

    ```bash
    git@github.com:GasyCoder/git@github.com:GasyCoder/bacc-examen-officiel-2024.git.git
    cd bacc-examen-officiel-2024
    ```

2. Installez les dépendances PHP :

    ```bash
    composer install
    ```

3. Copiez le fichier `.env.example` en `.env` et configurez vos paramètres de base de données :

    ```bash
    cp .env.example .env
    ```

    Ouvrez le fichier `.env` et modifiez les variables de configuration de la base de données :

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nom_de_votre_base_de_donnees
    DB_USERNAME=votre_nom_utilisateur
    DB_PASSWORD=votre_mot_de_passe
    ```

4. Générez la clé de l'application :

    ```bash
    php artisan key:generate
    ```

5. Exécutez les migrations pour créer les tables de la base de données :

    ```bash
    php artisan migrate
    ```

6. (Optionnel) Si vous avez des données fictives à ajouter, vous pouvez exécuter les seeders :

    ```bash
    php artisan db:seed
    ```

7. Installez les dépendances JavaScript :

    ```bash
    npm install
    ```

8. Compilez les assets front-end :

    ```bash
    npm run dev
    ```

## Exécution

1. Lancez le serveur de développement Laravel :

    ```bash
    php artisan serve
    ```

2. Ouvrez votre navigateur et accédez à l'URL suivante :

    ```
    http://localhost:8000
    ```

## Description API Rest

L’API des résultats d’examen BACCALAURÉAT permet de rechercher les résultats des examens en fonction du numéro de matricule ou du nom des candidats. Cette API fournit des informations telles que le nom du candidat, le centre d’examen, la mention, la série, le numéro d’inscription et la décision finale (admis ou non-admis).

## Endpoints

### Recherche par Matricule

- **URL** : `/search`
- **Méthode** : `POST`
- **Description** : Recherche les résultats d’examen d’un candidat en utilisant son numéro de matricule.

#### Requête

- **Headers** :
  - `Content-Type: application/json`
- **Body** :
  ```json
  {
      "matricule": "9471153"
  }
