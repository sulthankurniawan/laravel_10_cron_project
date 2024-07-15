@echo off
cd /d D:\laragon\www\laravel_10_cron_project
php artisan schedule:run >> NUL 2>&1