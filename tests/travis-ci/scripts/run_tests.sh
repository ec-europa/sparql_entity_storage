#!/bin/bash

set -x

install_codebase () {
    env
    mkdir -p "${SITE_DIR}/web/modules"
    cp "${TRAVIS_BUILD_DIR}/tests/travis-ci/fixtures/composer.json.dist" "${SITE_DIR}/composer.json"
    perl -i -pe's/\$\{([^}]+)\}/$ENV{$1}/' "${SITE_DIR}/composer.json"
    cd "${SITE_DIR}" && COMPOSER_MEMORY_LIMIT=-1 composer install --no-interaction --prefer-dist
    cp -R "${TRAVIS_BUILD_DIR}" "${SITE_DIR}/web/modules/sparql_entity_storage"
}

case "${TEST}" in
    PHPCodeSniffer)
        cd "${TRAVIS_BUILD_DIR}" || exit
        composer install
        ./vendor/bin/phpcs
        exit $?
        ;;
    PHPStan)
        # Deploy the codebase.
        install_codebase
        cp "${TRAVIS_BUILD_DIR}/tests/travis-ci/fixtures/phpstan.neon.dist" "${SITE_DIR}/phpstan.neon"

        # Run static analysis.
        ./vendor/bin/phpstan analyse ./web/modules/sparql_entity_storage
        exit $?
        ;;
    PHPUnit)
        set -x
        # Deploy the codebase.
        install_codebase

        # Setup PHPUnit.
        cp "${TRAVIS_BUILD_DIR}/tests/travis-ci/fixtures/phpunit.xml.dist" "${SITE_DIR}/phpunit.xml"

        # Virtuoso setup.
        mkdir "${SITE_DIR}/virtuoso"
        docker run --name virtuoso -p 8890:8890 -p 1111:1111 -e SPARQL_UPDATE=true -v "${SITE_DIR}/virtuoso":/data -d tenforce/virtuoso

        # Sleep to ensure that docker services are available.
        sleep 15

        # Run PHPUnit.
        cd "${SITE_DIR}" || exit
        ./vendor/bin/phpunit --verbose
        exit $?
        ;;
    *)
        echo "Unknown test '$1'"
        exit 1
esac
