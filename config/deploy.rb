require 'capistrano/ext/multistage'

set :application, "epicgamejam"
set :scm,            "git"
set :repository,  "git@github.com:tonifisler/epicgamejam.git"
set :branch,         "dev"
set :stages, %w(staging production)

role :app, 'web420.webfaction.com'
role :web, 'web420.webfaction.com'

# USER
set :user,            "tonifisler"
set :group,           "tonifisler"
set :runner_group,    "tonifisler"
set :use_sudo,    false
default_run_options[:pty] = true
ssh_options[:forward_agent] = true

# APP
set :application,     "epicgamejam"

set :default_env, { path: "/home/tonifisler/bin:$PATH" }

# The domain and the path to your app directory
set :domain,    "staging.epicgamejam.net"
set :deploy_to, "/home/#{user}/webapps/#{application}"


set :app_path,        "drupal"
set :shared_children, ['drupal/sites/default/files']
set :shared_files,    ['drupal/sites/default/settings.php']
set :download_drush,  true

set  :keep_releases,   3
after "deploy:update", "deploy:cleanup"