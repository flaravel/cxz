@servers(['cxz' => ['hulu_pro']])

@task('deploy', ['on' => ['cxz']])
cd /var/docker/dnmp/www/cxz
git pull origin master
composer install
@endtask

