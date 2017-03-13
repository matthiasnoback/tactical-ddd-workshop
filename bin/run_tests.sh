#!/usr/bin/env bash

docker-compose run --rm devtools /bin/bash -c "vendor/bin/phpunit"
