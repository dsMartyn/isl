#!/bin/bash

# Syncing Trellis & Bedrock-based WordPress environments with WP-CLI aliases
# Version 1.1.0
# Copyright (c) Ben Word

DEVDIR="web/app/uploads/"
DEVSITE="https://is.local"
DEVURL="is.local"

PRODDIR="web@www.invisible-systems.com:/srv/www/www.invisible-systems.com/shared/uploads/"
PRODSITE="https://www.invisible-systems.com"
PRODURL="www.invisible-systems.com"

STAGDIR="web@is.lsweb.co.uk:/srv/www/is.lsweb.co.uk/shared/uploads/"
STAGSITE="https://is.lsweb.co.uk"
STAGURL="is.lsweb.co.uk"

FROM=$1
TO=$2
LOCAL=false

if [[ $3 == "--local" ]]; then
  LOCAL=true
fi

bold=$(tput bold)
normal=$(tput sgr0)

case "$1-$2" in
  production-development) DIR="down ⬇️ "           FROMSITE=$PRODSITE; FROMDIR=$PRODDIR; FROMURL=$PRODURL; TOSITE=$DEVSITE;  TODIR=$DEVDIR;  TOURL=$DEVURL; ;;
  staging-development)    DIR="down ⬇️ "           FROMSITE=$STAGSITE; FROMDIR=$STAGDIR; FROMURL=$STAGURL; TOSITE=$DEVSITE;  TODIR=$DEVDIR;  TOURL=$DEVURL; ;;
  development-production) DIR="up ⬆️ "             FROMSITE=$DEVSITE;  FROMDIR=$DEVDIR;  FROMURL=$DEVURL;  TOSITE=$PRODSITE; TODIR=$PRODDIR; TOURL=$PRODURL; ;;
  development-staging)    DIR="up ⬆️ "             FROMSITE=$DEVSITE;  FROMDIR=$DEVDIR;  FROMURL=$DEVURL;  TOSITE=$STAGSITE; TODIR=$STAGDIR; TOURL=$STAGURL; ;;
  production-staging)     DIR="horizontally ↔️ ";  FROMSITE=$PRODSITE; FROMDIR=$PRODDIR; FROMURL=$PRODURL; TOSITE=$STAGSITE; TODIR=$STAGDIR; TOURL=$STAGURL; ;;
  staging-production)     DIR="horizontally ↔️ ";  FROMSITE=$STAGSITE; FROMDIR=$STAGDIR; FROMURL=$STAGURL; TOSITE=$PRODSITE; TODIR=$PRODDIR; TOURL=$PRODURL; ;;
  *) echo "usage: $0 production development | staging development | development staging | development production | staging production | production staging" && exit 1 ;;
esac

read -r -p "
🔄  Would you really like to ⚠️  ${bold}reset the $TO database${normal} ($TOSITE)
    and sync ${bold}$DIR${normal} from $FROM ($FROMSITE)? [y/N] " response

if [[ "$response" =~ ^([yY][eE][sS]|[yY])$ ]]; then
  # Change to site directory
  cd ../ &&
  echo

  # Make sure both environments are available before we continue
  availfrom() {
    local AVAILFROM
    if [[ "$LOCAL" = true && $FROM == "development" ]]; then
      AVAILFROM=$(wp option get home 2>&1)
    else
      AVAILFROM=$(wp "@$FROM" option get home 2>&1)
    fi
    if [[ $AVAILFROM == *"Error"* ]]; then
      echo "❌  Unable to connect to $FROM"
      exit 1
    else
      echo "✅  Able to connect to $FROM"
    fi
  };
  availfrom

  availto() {
    local AVAILTO
    if [[ "$LOCAL" = true && $TO == "development" ]]; then
      AVAILTO=$(wp option get home 2>&1)
    else
      AVAILTO=$(wp "@$TO" option get home 2>&1)
    fi

    if [[ $AVAILTO == *"Error"* ]]; then
      echo "❌  Unable to connect to $TO"
      exit 1
    else
      echo "✅  Able to connect to $TO"
    fi
  };
  availto
  echo

  # Export/import database, run search & replace
  if [[ "$LOCAL" = true && $TO == "development" ]]; then
    wp db export &&
    wp db reset --yes &&
    wp "@$FROM" db export - | wp db import - &&
    echo "Replacing $FROMSITE with $TOSITE in database" &&
    wp search-replace --url=$FROMURL "$FROMURL" "$TOURL" --network --all-tables --skip-columns=guid &&
    echo "Replacing $FROMURL with $TOURL in database" &&
    wp "@$TO" search-replace --url=$FROMURL "$FROMSITE" "$TOSITE" --network --all-tables --skip-columns=guid
  elif [[ "$LOCAL" = true && $FROM == "development" ]]; then
    wp "@$TO" db export &&
    wp "@$TO" db reset --yes &&
    wp db export - | wp "@$TO" db import - &&
    echo "Replacing $FROMSITE with $TOSITE in database" &&
    wp "@$TO" search-replace --url=$FROMURL "$FROMURL" "$TOURL" --network --all-tables --skip-columns=guid &&
    echo "Replacing $FROMURL with $TOURL in database" &&
    wp "@$TO" search-replace --url=$FROMURL "$FROMSITE" "$TOSITE" --network --all-tables --skip-columns=guid
  else
    wp "@$TO" db export &&
    wp "@$TO" db reset --yes &&
    wp "@$FROM" db export - | wp "@$TO" db import - &&
    echo "Replacing $FROMSITE with $TOSITE in database" &&
    wp "@$TO" search-replace --url=$FROMURL "$FROMURL" "$TOURL" --network --all-tables --skip-columns=guid &&
    echo "Replacing $FROMURL with $TOURL in database" &&
    wp "@$TO" search-replace --url=$FROMURL "$FROMSITE" "$TOSITE" --network --all-tables --skip-columns=guid
  fi

  # Sync uploads directory
  chmod -R 755 web/app/uploads/ &&
  if [[ $DIR == "horizontally"* ]]; then
    [[ $FROMDIR =~ ^(.*): ]] && FROMHOST=${BASH_REMATCH[1]}
    [[ $FROMDIR =~ ^(.*):(.*)$ ]] && FROMDIR=${BASH_REMATCH[2]}
    [[ $TODIR =~ ^(.*): ]] && TOHOST=${BASH_REMATCH[1]}
    [[ $TODIR =~ ^(.*):(.*)$ ]] && TODIR=${BASH_REMATCH[2]}

    ssh -o ForwardAgent=yes $FROMHOST "rsync -aze 'ssh -o StrictHostKeyChecking=no' --progress $FROMDIR $TOHOST:$TODIR"
  else
    rsync -az --progress "$FROMDIR" "$TODIR"
  fi

  # Slack notification when sync direction is up or horizontal
  # if [[ $DIR != "down"* ]]; then
  #   USER="$(git config user.name)"
  #   curl -X POST -H "Content-type: application/json" --data "{\"attachments\":[{\"fallback\": \"\",\"color\":\"#36a64f\",\"text\":\"🔄 Sync from ${FROMSITE} to ${TOSITE} by ${USER} complete \"}],\"channel\":\"#site\"}" https://hooks.slack.com/services/xx/xx/xx
  # fi
  echo -e "\n\n🔄  Sync from $FROM to $TO complete.\n\n    ${bold}$TOSITE${normal}\n"
fi
