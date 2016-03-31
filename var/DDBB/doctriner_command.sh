#./vendor/doctrine/doctrine-module/bin/doctrine-module orm:convert-mapping --namespace="Own\\IndexBundle\\Entity\\" --force  --from-database annotation ./src/Own/IndexBundle/
#php app/console doctrine:generate:entities ./src/Own/IndexBundle --regenerate-entities=true --generate-annotations=true
#./vendor/doctrine/doctrine-module/bin/doctrine-module orm:generate-entities ./src/Own/IndexBundle --regenerate-entities=true --generate-annotations=true
#rm src/Own/IndexBundle/Entity/*.php~ -v

sudo chown todo:apache * -Rf
sudo chown mrusso:apache * -Rf
sudo chmod 775 * -Rf
#mysqldump -ublog -pbl0g -c -d --skip-extended-insert --add-drop-table --add-locks --create-options --quick --lock-tables www_blog > ./data/DDBB/www_blog_structure.sql
mysqldump -umini_project -pm1n1_pr0j3ct -c --skip-extended-insert --add-drop-table --add-locks --create-options --quick --lock-tables mini_project > ./var/DDBB/mini_project.sql
php bin/console doctrine:mapping:convert --namespace="MRusso\\LibBundle\\Entity\\" --force  --from-database annotation ./src/
php bin/console doctrine:generate:entities MRusso/Lib --no-backup
php bin/console doctrine:mongodb:generate:documents MrussoLibBundle --no-backup
php bin/console cache:clear
php bin/console doctrine:cache:clear-query
php bin/console doctrine:cache:clear-result
php bin/console doctrine:cache:clear-metadata                       
sudo chown todo:apache * -Rf
sudo chown mrusso:apache * -Rf
sudo chmod 775 * -Rf
