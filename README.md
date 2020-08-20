## install
1. `php init` 
2. db `common\config\main-local.php`
3.  run
   ```
    php yii migrate --migrationPath=@yii/rbac/migrations/
    php yii migrate
    php yii rbac/init
   ```
4. `php yii serve --docroot="backend/web"`