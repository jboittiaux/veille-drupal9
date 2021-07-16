# Formation Drupal 9.2

Ce projet permet d'exécuter un environnement faisant tourner drupal 9.2 sur php 8 avec une base de données PostgreSQL 13.

### Dépendances

* docker
* npm (pour les raccourcis de commandes)

## Installation

```shell
git clone git@github.com:jboittiaux/veille-drupal9.git drupal9
```

## Démarrage de l'environnement

Via docker compose:
```shell
docker compose up -d
```

Via npm:
```shell
npm run start
```

> *Au premier démarrage, drupal devrait s'installer tout seul comme un grand*

## Accès à l'application

Une fois l'environnement lancé, l'application est accessible à l'adresse suivante : http://localhost

> *Au premier démarrage, drupal va lancer sa procédure d'installation*
