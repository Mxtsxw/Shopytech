# Shopytech

> Shopytech est un site de e-commerce pour des produits de fêtes

## Technologies

Le site est réalisé avec le langage de programmation PHP et est basé sur l'architecture MVC.
Le design est principalement réalisé à l'aide de la bibliothèque [MDBootstrap](https://mdbootstrap.com/).

## Installation 

Pour lancer le site, il faut vous munir d'un serveur web interprétant le PHP et d'une base de données Mysql. Nous vous recommendons d'utiliser l'outil XAMPP et ses alternatives.
Vous devrez ensuite initialiser votre base de données en lançant le script d'insertion disponible [ici](https://github.com/Matsew-uwu/Shopytech/blob/main/static/ressources/web4shop2022.sql).

## Architecture

- Le site web est structuré en utilisant l'architecture MVC (Modèle-Vue-Contrôleur). Les différentes parties de cette architecture sont réparties dans trois répertoires distincts : Models, Views et Controllers.
- Les fichiers statiques, tels que les fichiers css, js, ainsi que les images sont placés dans le répertoire static. On y retrouve aussi les fichiers des bibliothèques utilisées.
- Un répertoire *handlers* est également présent et contient les fichiers permettant de traiter les informations issues des formulaires.

```
Shopytech/
├─ controllers/
│  ├─ // Les controlleurs
│  ├─ router.php
├─ models/
│  ├─ Model.php
│  ├─ Class.php
│  ├─ ClassManager.php
│  ├─ // les modèles
├─ views/
│  ├─ Template.php
│  ├─ View.php
│  ├─ // Les vues
├─ Handlers/
│  ├─ // Les fichiers de traitements des formulaires
├─ static/
│  ├─ // Les fichiers statiques (images, ressources css, js) et bibiliothèques
├─ index.php
```

## Screenshots
![image](https://user-images.githubusercontent.com/85303770/212147657-829e2247-a571-47d0-a85a-8db647d17b3a.png)



> Réalisé dans le cardre du module **ISI-WEB à Polytech Lyon - filière Informatique**.

> 📌 Fait par **Matthieu & Clément**.
