# Formation Drupal 9.2

Ce projet permet d'exécuter un environnement faisant tourner drupal 9.2 sur php 8 avec une base de données PostgreSQL 13.

### Dépendances

* docker
* npm (pour les raccourcis de commandes)

## Installation

Clonage du projet
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

> *Au premier démarrage, drupal devrait s'installer tout seul comme un grand (ça peut-être long par contre)*

## Accès à l'application

Une fois l'environnement lancé, l'application est accessible à l'adresse suivante : http://localhost

> *Au premier démarrage, drupal va lancer sa procédure d'installation*

Une fois l'installation effectuée, import de la configuration:

```shell
docker compose exec app ./vendor/bin/drush cim
```

-----

## Raccourcis

Lancement de l'environnement:
```shell
npm run start
```
```shell
docker compose up -d
```

Arrêt de l'environnement:
```shell
npm run stop
```
```shell
docker compose down
```

Accès bash:
```shell
npm run bash
```
```shell
docker compose exec app bash
```

Afficher les logs:
```shell
npm run logs
```
```shell
docker compose logs -f app
```

Exporter les configurations:
```shell
npm run drush-cex
```
```shell
docker compose exec app ./vendor/bin/drush cex
```

Importer les configurations:
```shell
npm run drush-cim
```
```shell
docker compose exec app ./vendor/bin/drush cim
```
