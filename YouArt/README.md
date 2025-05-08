# Cahier des Charges : YouArt

## 1. Contexte et Objectifs du Projet

### 1.1 Contexte
"YouArt" est une plateforme en ligne innovante développée avec Laravel et Tailwind CSS qui soutient les artistes spécialisés dans le dessin et les amateurs d'art. Elle leur offre un espace pour s'exprimer, collaborer et découvrir des créations artistiques variées. L'objectif principal est de créer une communauté artistique interactive et accessible.

### 1.2 Problématique
Les artistes spécialisés dans le dessin rencontrent souvent des difficultés à exposer leurs œuvres, à obtenir de la visibilité et à interagir avec une communauté engagée. De plus, la vente d'œuvres d'art en ligne reste un défi en raison du manque de plateformes adaptées aux besoins des artistes et des passionnés. YouArt vise à répondre à ces défis en proposant un espace numérique dédié à la création, au partage et à la monétisation des œuvres de dessin.

### 1.3 Objectifs Généraux
- **Présentation des œuvres** : Permettre aux artistes de créer des galeries personnalisées pour mettre en valeur leurs créations.
- **Vente en ligne** : Offrir un système de paiement sécurisé pour vendre des œuvres d'art directement sur la plateforme.
- **Interaction communautaire** : Favoriser les échanges entre artistes et amateurs d'art via un système de likes, commentaires et abonnements.
- **Apprentissage** : Proposer des ateliers vidéo pour le développement des compétences artistiques.

### 1.4 Objectifs Spécifiques
- Faciliter la création de profils d'artistes et d'amateurs d'art personnalisés.
- Intégrer un système de paiement Stripe pour la vente des œuvres.
- Offrir des ateliers vidéo et des ressources d'apprentissage.
- Assurer une expérience utilisateur intuitive, compatible desktop et mobile.

## 2. Périmètre Fonctionnel

### 2.1 Fonctionnalités Principales

#### a. Gestion des Utilisateurs
- Inscription et connexion avec authentification sécurisée.
- Gestion des profils utilisateurs (informations personnelles, biographie, photo de profil).
- Attribution de rôles : artiste, amateur d'art, administrateur.
- Système de suivi d'artistes pour les amateurs d'art.

#### b. Galeries et Œuvres d'Art
- Création et personnalisation de galeries d'œuvres par les artistes.
- Ajout, modification et suppression d'œuvres (titre, description, prix, dimensions, image).
- Visualisation publique des galeries et des œuvres individuelles.
- Système de likes pour les œuvres d'art.

#### c. Ateliers et Ressources
- Accès à une liste d'ateliers sous forme de vidéos YouTube intégrées.
- Classification des ateliers par niveau de compétence.
- Système de likes pour les ateliers vidéo.

#### d. Vente d'Œuvres
- Mise en vente d'œuvres avec prix défini par l'artiste.
- Système de paiement en ligne sécurisé via Stripe.
- Gestion des transactions et suivi des achats.
- Marquage automatique des œuvres vendues.

#### e. Interaction et Communauté
- Possibilité de liker des œuvres et des ateliers.
- Système d'abonnement aux artistes (follow/unfollow).
- Espaces personnels pour artistes et amateurs d'art.

### 2.2 Fonctionnalités Administratives
- Modération des contenus publiés.
- Gestion des utilisateurs (activation, suspension, suppression).
- Supervision des ateliers et ventes.
- Interface d'administration dédiée.

## 3. Spécifications Techniques

### 3.1 Technologies Utilisées
- **Frontend** : HTML, CSS (Framework : Tailwind CSS), JavaScript, Blade.
- **Backend** : Laravel PHP.
- **Base de Données** : PostgreSQL (gestion via PDO).
- **Authentification** : Utilisation de bcrypt pour le hachage des mots de passe.
- **Paiement en ligne** : API Stripe pour les transactions.
- **Hébergement** : Serveur web compatible PHP/PostgreSQL.

### 3.2 Accessibilité
- Conception responsive, adaptée aux écrans desktop, tablettes et mobiles.
- Navigation intuitive pour tous les utilisateurs.

### 3.3 Sécurité
- Validation stricte des entrées utilisateur pour prévenir les injections SQL et attaques XSS.
- Mise en place de protections contre les attaques CSRF.
- Gestion des sessions avec des protocoles de sécurité avancés.

## 4. Détail des Rôles et Fonctions

### 4.1 Artiste
- Création et gestion d'un profil d'artiste avec biographie et photo de profil.
- Ajout, modification et suppression d'œuvres dans des galeries personnalisées.
- Vente directe des œuvres avec définition du prix.
- Suivi des ventes et des œuvres vendues.
- Interaction avec la communauté (likes, abonnés).
- Accès aux ateliers vidéo et ressources.

### 4.2 Amateur d'Art
- Création d'un profil personnel avec préférences artistiques.
- Exploration et achat d'œuvres en vente directe.
- Suivi des œuvres favorites et des artistes suivis (abonnements).
- Interaction avec la communauté (likes, abonnements).
- Accès aux ateliers vidéo et aux ressources d'apprentissage.

### 4.3 Administrateur
- Gestion et modération des utilisateurs (activation, suspension, suppression).
- Supervision des œuvres mises en ligne.
- Contrôle des transactions et des paiements.
- Gestion des ateliers vidéo et des ressources pédagogiques.

## 5. Fonctionnalités Bonus (À Développer)

### 5.1 Vente aux Enchères
- Système d'enchères en temps réel avec une durée déterminée pour chaque vente.
- Affichage des mises en direct avec mise à jour dynamique des offres.
- Notification aux participants lorsqu'une nouvelle enchère dépasse leur offre.
- Gestion des paiements une fois l'enchère terminée pour l'utilisateur gagnant.
- Historique des enchères permettant aux utilisateurs de consulter leurs anciennes participations.

### 5.2 Système de Commentaires
- Possibilité de commenter les œuvres d'art et les ateliers.
- Notifications pour les commentaires reçus.
- Modération des commentaires par les administrateurs.

### 5.3 Messagerie Interne
- Système de messagerie privée entre utilisateurs.
- Possibilité de négocier directement avec les artistes.
- Notifications pour les nouveaux messages reçus.

## 6. Développements Techniques Réalisés

La plateforme a été développée avec les éléments suivants :

- Système d'authentification et de gestion des rôles (artiste, amateur d'art, administrateur).
- Gestion complète des œuvres d'art (CRUD).
- Système de paiement fonctionnel via Stripe.
- Gestion des workshops vidéo.
- Système de likes et d'abonnements.
- Interface d'administration pour la gestion des utilisateurs et du contenu.
- Conception responsive avec Tailwind CSS.

## 5. Planification Estimée
- Phase 1 : Étude et Conception (Janvier - Février 2025)
14/02/2025 : Livraison des maquettes et des diagrammes UML (cas d’utilisation, diagrammes de classes).
Analyse des besoins et rédaction du cahier des charges.
Conception des maquettes et des diagrammes UML.

- Phase 2 : Développement Backend et Frontend (Février - Mars 2025)
Développement des fonctionnalités backend :
Gestion des utilisateurs et authentification.
Création des galeries et gestion des œuvres.
Mise en place du système de vente et de paiement.
Développement frontend :
Intégration des maquettes et développement de l’interface utilisateur.
Tests d'affichage responsive et d'ergonomie.

- Phase 3 : Tests et Corrections (Mars - Début Avril 2025)
Tests unitaires et fonctionnels de chaque module.
Correction des bugs et optimisation des performances.
Ajustements de l’ergonomie et de l’interface utilisateur.

- Phase 4 : Déploiement et Lancement (Avril 2025)
20/04/2025 : Livraison finale de la plateforme avec toutes les fonctionnalités prévues.
Mise en ligne de la plateforme et tests en conditions réelles.
Collecte des retours utilisateurs et corrections post-lancement.

##6. Annexes
- Maquettes d’interfaces utilisateur pour chaque écran principal (disponibles le 14/02/2025).
- Diagrammes UML (cas d’utilisation, diagrammes de classes) pour décrire les interactions et la structure technique (livrés le 14/02/2025).

Ce cahier des charges reflète l'état actuel de la plateforme YouArt et les fonctionnalités à venir, avec la vente aux enchères comme développement futur prioritaire.
