require 'fileutils'
require 'zlib'

namespace :hotfix do
  task :fix_permissions do
    count = fetch(:keep_releases, 5).to_i
    run("ls -1dt #{releases_path}/* | tail -n +#{count + 1} | xargs chmod -R 777")
  end
end


# Task to build styles assets in production server
namespace :assets do
  desc "Output versions"
  task :versions do
    run "cd #{current_path} && npm install --silent"
  end
  desc "Build assets on the server"
  task :build do
    run "cd #{current_path} && npm install --silent"
    run "cd #{current_path} && ./node_modules/.bin/bower install --config.interactive=false"
    run "cd #{current_path} && ./node_modules/.bin/gulp build"
  end
end

set :backup_path, "backups"
set :remote_tmp_dir, "/tmp"

# Inspirate form Capifony project
namespace :database do
  namespace :dump do
    task :remote do
      filename  = "#{application}_dump.#{Time.now.utc.strftime("%Y%m%d%H%M%S")}.sql.gz"
      sqlfile = "#{remote_tmp_dir}/#{filename}"

      run "#{drush_cmd} -r #{latest_release}/#{app_path} sql-dump | gzip -9 > #{sqlfile}"

      FileUtils::mkdir_p("#{backup_path}")

      download(sqlfile, "#{backup_path}/#{filename}")

      begin
        FileUtils.ln_sf(filename, "#{backup_path}/#{application}_dump.latest.sql.gz")
      rescue Exception # fallback for file systems that don't support symlinks
        FileUtils.cp_r("#{backup_path}/#{filename}", "#{backup_path}/#{application}_dump.latest.sql.gz")
      end

      run "rm #{sqlfile}"
    end
  end

  namespace :copy do
    desc "Copy remote database into local and load it here"
    task :to_local do
      gzfile  = "#{backup_path}/#{application}_dump.latest.sql.gz"
      sqlfile = "#{backup_path}/#{application}_dump.sql"

      database.dump.remote

      # be sure the file not already exist before un-gziping it
      if File.exist?(sqlfile)
        FileUtils.rm(sqlfile)
      end

      puts sqlfile

      f = File.new(sqlfile, "a+")
      gz = Zlib::GzipReader.new(File.open(gzfile, "r"))
      f << gz.read
      f.close

      run_locally "cd #{app_path} && drush sql-connect < ../#{sqlfile}"

      FileUtils.rm(sqlfile)
    end
  end
end