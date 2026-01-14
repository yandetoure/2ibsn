# Guide d'Administration - 2IBSN

## Accès au Dashboard Admin

1. **URL de connexion**: `/admin/login`
2. **Identifiants par défaut** (après migration et seed):
   - Email: `admin@2ibsn.sn`
   - Mot de passe: `admin123`

⚠️ **Important**: Changez le mot de passe après la première connexion!

## Fonctionnalités Principales

### 1. Gestion des Élèves

#### Inscription
- Formulaire d'inscription public disponible à `/inscription`
- Toutes les informations du formulaire sont enregistrées
- Création automatique d'une inscription (enrollment) lors de l'inscription

#### Administration
- **Liste des élèves**: `/admin/students`
  - Recherche par nom, téléphone
  - Filtres par statut et niveau
  - Export Excel/CSV disponible
  
- **Import d'élèves**: `/admin/students/import`
  - Format Excel/CSV accepté
  - Colonnes requises: Prénom, Nom, Sexe, Date de naissance, etc.
  - Validation automatique des données

- **Export d'élèves**: Bouton "Exporter" dans la liste
  - Exporte tous les élèves (avec filtres appliqués)
  - Format Excel avec toutes les informations

### 2. Gestion des Paiements

#### Enregistrement
- **Nouveau paiement**: `/admin/payments/create`
  - Sélection de l'élève
  - Association automatique à l'inscription active
  - Types: 1ère Mensualité, Mensualité, Autre

#### Reçus Électroniques
- **Génération de reçu**: Disponible depuis la page de détails du paiement
  - Format PDF professionnel
  - Numéro de reçu automatique (format: REC-YYYY-XXXXXX)
  - Téléchargement et visualisation

### 3. Gestion des Niveaux

- **Création/Modification**: `/admin/levels`
- Niveaux préscolaires: PS, MS, GS
- Niveaux élémentaires: CI, CP, CE1, CE2, CM1, CM2
- Niveaux secondaires: 6ème, 5ème, 4ème, 3ème
- Définition de la mensualité pour chaque niveau

### 4. Gestion des Médias

- **Upload de médias**: `/admin/media`
  - Types: Bannière, Galerie, Logo, Autre
  - Formats acceptés: JPG, PNG, GIF (max 10MB)
  - Ordre d'affichage configurable
  - Activation/Désactivation

### 5. Années Scolaires

- **Gestion**: `/admin/school-years`
- Création d'années scolaires
- Marquage de l'année courante
- Association aux inscriptions

### 6. Paramètres

- **Configuration**: `/admin/settings`
- Informations de l'institut (nom, adresse, contacts)
- Images (bannière, logo)

## Installation et Configuration

### 1. Migrations

```bash
php artisan migrate
```

### 2. Seeders (Données initiales)

```bash
php artisan db:seed
```

Cela créera:
- Les niveaux (PS, MS, GS, CI, CP, CE1, CE2, CM1, CM2, 6ème, 5ème, 4ème, 3ème)
- Un utilisateur admin (admin@2ibsn.sn / admin123)

### 3. Lien de stockage

```bash
php artisan storage:link
```

Nécessaire pour l'upload de fichiers et la génération de PDF.

## Structure de la Base de Données

### Tables Principales

- **students**: Informations des élèves
- **enrollments**: Inscriptions des élèves
- **payments**: Paiements enregistrés
- **receipts**: Reçus générés (PDF)
- **levels**: Niveaux scolaires
- **school_years**: Années scolaires
- **media**: Médias (images)
- **settings**: Paramètres de l'application

## Sécurité

- Authentification requise pour toutes les routes admin
- Middleware `admin` vérifie que l'utilisateur est administrateur
- Validation des données sur tous les formulaires
- Protection CSRF sur tous les formulaires

## Support

Pour toute question ou problème, contactez le développeur.
