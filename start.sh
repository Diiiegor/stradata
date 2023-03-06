#!/bin/bash
./vendor/bin/sail php artisan migrate:refresh --seed
./vendor/bin/sail php artisan migrate:refresh --seed
./vendor/bin/sail php artisan db:seed --class=PeopleSeeder
