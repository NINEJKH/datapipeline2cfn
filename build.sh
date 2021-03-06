#!/usr/bin/env bash

__DIR__="$(dirname "$("${READLINK_PATH:-readlink}" -f "$0")")"

# required libs
source "${__DIR__}/.bash/functions.shlib"

set -E
trap 'throw_exception' ERR

# create version file
if [[ ! -z "${TRAVIS_TAG}" ]]; then
  echo "${TRAVIS_TAG}" > version.txt
elif [[ ! -z "${TRAVIS_COMMIT}" ]]; then
  echo "${TRAVIS_COMMIT}" > version.txt
fi

# composer
consolelog "composer install"
composer install \
  --no-interaction \
  --prefer-dist \
  --no-suggest \
  --quiet \
  --verbose

# run tests
if [[ -f vendor/bin/phpunit ]] && ! vendor/bin/phpunit; then
  exit 1
fi

consolelog "composer cleanup"
composer install \
  --no-dev \
  --quiet \
  --verbose

composer dump-autoload \
  --no-dev \
  --classmap-authoritative \
  --quiet \
  --verbose

php create-phar.php datapipeline2cfn.phar
chmod +x datapipeline2cfn.phar

./datapipeline2cfn.phar --version
