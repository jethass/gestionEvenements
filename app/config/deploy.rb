set :application, "Omea Gestion Telco"
set :domain,      "gestiontelco.dev.vm.omertelecom.fr"
set :deploy_to,   "/home/gestiontelco_vm/deploy"
set :app_path,    "app"

set :use_sudo, false
set :user,     "gestiontelco_vm"
set :password, "gestiontelco"

set :repository,  "svn://svn.bo.omertelecom.fr/gestiontelco_vm/trunk"
set :scm,         :subversion
set :deploy_via,  :capifony_copy_local

set :use_composer, true
set :use_composer_tmp, true
set :composer_options, "--no-dev --verbose --prefer-dist --optimize-autoloader --no-progress"
set :symfony_env_prod, "dev"
if symfony_env_prod == "dev"
    set :clear_controllers, false
    set :composer_options, "--verbose --prefer-dist --optimize-autoloader --no-progress"
end
#set :cache_warmup, false

set :model_manager, "doctrine"
role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set :keep_releases,      3
set :shared_files,       ["app/config/parameters.yml"]
set :shared_children,    [log_path]

after "symfony:bootstrap:build" do
    set :php_bin,     "/usr/local/zend/bin/php"
end

after "deploy:create_symlink" do
    run "rm -rf /home/gestiontelco_vm/site && ln -s #{current_path}/web /home/gestiontelco_vm/site"
end

after "deploy:setup" do
    run "mkdir -p #{shared_path}/#{log_path} && chmod g+w #{shared_path}/#{log_path}"
end

# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL
