@servers(['cxz' => ['root@106.54.7.136']])

@task('deploy', ['on' => ['cxz']])
cd /var/docker/dnmp/www/cxz
git pull origin master
composer install
@endtask

