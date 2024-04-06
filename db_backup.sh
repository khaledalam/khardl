#!/usr/bin/bash

DATABASE_NAME=
DATABASE_USER=
DATABASE_PASSWORD=

now=$(date +"%Y_%m_%d_%H:%M:%S")
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
cd $DIR && /usr/bin/mysqldump $DATABASE_NAME  \
  > $DIR/db_backups/backup_$now.sql -u $DATABASE_USER --password=$DATABASE_PASSWORD \
  --skip-extended-insert --no-tablespaces;

# Remove old backups (modified files more than 30 days ago)
find $DIR/db_backups/* -mtime +30 -exec rm {} \;