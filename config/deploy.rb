require 'capistrano/ext/multistage'
require 'colored'

# load custom recipes
load 'config/recipes'

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

# set correct path and drush php for webfaction ser ver
# (capistrano 2! -> :default_env for capistrano 3)
set :default_environment, {
  'PATH' => "/home/tonifisler/bin:$PATH",
  'DRUSH_PHP' => "/home/tonifisler/bin/php"
}

# The domain and the path to your app directory
set :deploy_to, "/home/#{user}/webapps/#{application}"


set :app_path,        "drupal"
set :shared_children, ['drupal/sites/default/files']
set :shared_files,    ['drupal/sites/default/settings.php']
set :download_drush,  true

set  :keep_releases,   3

# Output pretty logs
STDOUT.sync
before "deploy:update_code" do
    puts "Starting Code Update".green
end

after "deploy:update_code" do
    puts "Code Updated".green
end

after "deploy:finalize_update" do
    puts "Update Finalized".green
end

before "drush:get" do
    print "Installing Drush.........................."
end

after "drush:get" do
    puts "✓".green
end

before "drupal:symlink_shared" do
    print "Creating symlinks to shared folder........"
end

after "drupal:symlink_shared" do
    puts "✓".green
end

before "drush:site_offline" do
    print "Putting Drupal Maintenance Mode ON........"
end

after "drush:site_offline" do
    puts "✓".green
end

before "drush:updatedb" do
    print "Updating Database........................."
end

after "drush:updatedb" do
    puts "✓".green
end

before "drush:cache_clear" do
    print "Clearing Drupal Cache....................."
end

after "drush:cache_clear" do
    puts "✓".green
end

before "drush:feature_revert" do
    print "Reverting Drupal Features................."
end

after "drush:feature_revert" do
    puts "✓".green
end

before "drush:site_online" do
    print "Putting Drupal Maintenance Mode OFF......."
end

after "drush:site_online" do
    puts "✓".green
end

before "deploy:create_symlink" do
    print "Setting Release as Current................"
end

after "deploy:create_symlink" do
    puts "✓".green
end

before "deploy:cleanup" do
    print "Cleaning Up..............................."
end

after "deploy:cleanup" do
    puts "✓".green
end

# before "deploy:site_online", "assets:build"

after "deploy:update", "deploy:cleanup"
# before "deploy:cleanup", "hotfix:fix_permissions"
logger.level = Logger::DEBUG
