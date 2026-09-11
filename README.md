# Gestionnaire de Citations — Application Symfony

Application web développée avec le framework Symfony permettant de recenser, gérer et classer des citations historiques et culturelles.

---

## Fonctionnalités

* **CRUD complet :**
    * Liste des citations avec gestion de l'affichage vide (« Aucune citation disponible »).
    * Fiche détaillée par citation.
    * Création et modification via formulaires Symfony (`QuoteType`).
    * Suppression sécurisée en méthode `POST` avec vérification de jeton CSRF et boîte de dialogue de confirmation native.
* **Validation des données :** Contraintes strictes sur l'entité (`NotBlank`, `Length`, `Range`) avec messages d'erreur personnalisés en français et désactivation de la validation HTML5 par défaut pour garantir le contrôle côté serveur.
* **Fonctionnalité libre — Classement d'Aura :** Tableau d'honneur (`/quote/leaderboard`) classant les citations selon leur score d'influence (*Aura*) par ordre décroissant via Doctrine (`findBy`).
* **Interface responsive :** Intégration de Bootstrap 5 et du thème de formulaires natif Symfony (`bootstrap_5_layout.html.twig`).

---

## Modèle de données (`Quote`)

En plus du contenu textuel (`content`) et de l'auteur (`author`), l'entité intègre plusieurs champs spécifiques :

| Champ | Type | Description |
| :--- | :--- | :--- |
| `source` | `string` (nullable) | Ouvrage, discours ou support d'origine de la citation. |
| `century` | `string` (nullable) | Siècle ou période historique de référence (ex. *Ier av. J.-C.*). |
| `language` | `string` (nullable) | Code ou langue d'origine de la formulation (ex. *la*, *fr*, *en*). |
| `context` | `text` (nullable) | Circonstances historiques ou anecdote entourant la citation. |
| `aura` | `integer` (nullable) | Score d'impact symbolique (entre -1 000 000 et 1 000 000). |
| `createdAt` | `datetime_immutable` | Date et heure de création en base (générée automatiquement). |

---

## Prérequis

* PHP >= 8.2
* Composer
* Symfony CLI (recommandé)
* SQLite ou MySQL / MariaDB

---

## Installation et lancement

### 1. Cloner le dépôt

```bash
git clone https://github.com/MathisH19/citations_projet.git
cd citations_projet
```

### 2. Installation des dépendances

```bash
composer install
```

### 3. Préparation de la base de données (SQLite)

Le projet est configuré par défaut pour utiliser un fichier SQLite local situé dans `var/data.db`.

Exécuter les commandes de création et de migration :

```bash
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:migrations:migrate --no-interaction
```

### 4. Démarrage de l'application

Lancer le serveur de développement Symfony :

```bash
symfony server:start -d
```

*(Alternative sans Symfony CLI : `php -S 127.0.0.1:8000 -t public`)*

Accéder à l'application depuis un navigateur web à l'adresse suivante :
`http://127.0.0.1:8000/quote`

---

## 5. Recréation du projet depuis zéro (Guide de conception)

Pour reproduire la configuration technique exacte de ce projet étape par étape :

### 5.1 Génération du squelette d'application

```bash
symfony new quotes-app --version="lts"
cd quotes-app
```

### 5.2 Ajout des dépendances Symfony

```bash
composer require --dev symfony/maker-bundle
composer require symfony/orm-pack
composer require symfony/twig-bundle
composer require symfony/form symfony/validator symfony/security-csrf
```

### 5.3 Paramétrage de la base de données

Définir dans le fichier `.env` :

```
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
```

### 5.4 Création de l'entité et des migrations

```bash
php bin/console make:entity Quote
# Renseigner les champs : content, author, source, century, language, context, aura
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

### 5.5 Création du formulaire et du contrôleur

```bash
php bin/console make:form QuoteType Quote
php bin/console make:controller QuoteController
```

### 5.6 Désactivation de la validation HTML5 (pour tests d'évaluation)

Dans `src/Form/QuoteType.php` :

```php
$resolver->setDefaults([
    'data_class' => Quote::class,
    'attr' => ['novalidate' => 'novalidate'],
]);
```

### 5.7 Application du thème Bootstrap 5

Dans `config/packages/twig.yaml` :

```yaml
twig:
    form_themes: ['bootstrap_5_layout.html.twig']
```

---

## 6. Commandes utiles pour l'évaluation

**Lister toutes les routes actives du module :**

```bash
php bin/console debug:router quote
```

**Réinitialiser complètement la base de données :**

```bash
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate --no-interaction
```

**Vider le cache de l'application :**

```bash
php bin/console cache:clear
```
