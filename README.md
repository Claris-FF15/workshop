# 💖 GirlyPlan

**GirlyPlan** est une application web de gestion de tâches simple, intuitive et visuellement stylée dans un univers *girly*. Elle permet à une utilisatrice de créer un compte, de s'authentifier, puis d’organiser ses tâches dans différentes catégories (importantes, répétitives, basiques et terminées).

---

## ✨ Fonctionnalités principales

- Création de compte et authentification
- Ajout, édition et suppression de tâches
- Classification des tâches par listes :
  - 📌 Importante
  - 🔁 Répétitive
  - 📋 Basique
  - ✅ Terminée
- Calendrier
- Interface agréable et girly ✨
- Architecture MVC claire et organisée

---

## 🛠️ Technologies utilisées

- **Langage principal** : PHP
- **Base de données** : MySQL (fichier `db_app.sql`)
- **Architecture** : Modèle MVC (Model - View - Controller)
- **Frontend** : HTML, CSS
- **Style** : Design girly custom

---

## 🚀 Installation

1. **Cloner le dépôt :**
   ```bash
   git clone https://github.com/Claris-FF15/workshop.git
   cd workshop
   ```
   
2. **Configurer la base de données :**
Importer le fichier db_app.sql dans votre SGBD (ex: phpMyAdmin ou MySQL CLI).
Modifier les informations de connexion à la base de données dans le fichier de configuration (dans le dossier config/).
3. **Démarrer le serveur local :**
Utilisez un serveur local comme XAMPP, WAMP ou MAMP.
Placez le projet dans le dossier htdocs (ou équivalent).
Accédez au site via http://localhost/workshop/public.

## 🗂️ Structure du projet

workshop/
│
├── config/ → Configuration de la base de données
├── controller/ → Contrôleurs (logique applicative)
├── model/ → Modèles (interaction avec la base de données)
├── view/ → Vues HTML (pages affichées à l'utilisateur)
├── public/ → Point d’entrée principal + ressources publiques
├── style/ → Feuilles de style CSS
└── db_app.sql → Script SQL pour générer la base de données

## 🔐 Utilisation

1. Créez un compte via l’interface de connexion.
2. Connectez-vous pour accéder à votre tableau de bord.
3. Ajoutez vos tâches dans la catégorie de votre choix :
   - 📌 Importante
   - 🔁 Répétitive
   - 📋 Basique
   - ✅ Terminée
4. Gérez vos tâches selon leur priorité et terminez-les à votre rythme !

---

## 👩‍💻 Auteur

Projet réalisé par **[Claris-FF15](https://github.com/Claris-FF15)** dans le cadre d’un *workshop* personnel.  
Développé avec ❤️ et une touche de girly ✨.

---

## ⚠️ Licence

Ce projet ne dispose **d’aucune licence officielle**.  
Tous droits réservés à l'autrice.  
Si vous souhaitez réutiliser tout ou partie de ce projet, merci de contacter l’autrice au préalable.

---
