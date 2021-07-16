#! /bin/bash

set -e

# install drupal
if [[ ! -d ${APP_DIR}/vendor ]]
then
    composer install
fi

# create user files dir
filesDir=${APP_DIR}/web/sites/default/files
if [[ ! -d $filesDir ]]
then
    mkdir -p $filesDir

    chown www-data:www-data $filesDir
    chmod 755 $filesDir
fi

exec "$@"
