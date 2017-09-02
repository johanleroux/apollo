@servers(['web' => 'forge@169.239.181.174'])

@task('deploy')
    cd /home/forge/apollo.lomejo.co.za
    git pull https://johanleroux:P1XKQf80xd8wPJAExpUv7sVX5jYC1DfI16a1VthekxB35ep43EU6VgjH2uskXpnS@github.com/IFMTYP/team19.git master
    composer install --no-interaction --prefer-dist --optimize-autoloader
    php artisan queue:restart
    php artisan snapshot:load db_forecasted
@endtask