#!/bin/sh
if [ -n "$DYNO" ]  && [ -n "$ENV" ]; then
    php init --env=$ENV --overwrite=All
    php yii migrate/up --interactive=0
    php yii cache/flush-all
    php yii cache/flush-schema --interactive=0
    php artisan clear-compiled
    php artisan optimize
    chmod -R 777 frontend/web/
    chmod -R 777 backend/web/
fi
