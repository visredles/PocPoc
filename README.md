1. Overview
>This Software was designed to publish images. It's still in an early
development state so don't expect much.

2. Requirements
>PHP,MySQL,mod_rewrite,GD>=1.8

3. Installation
 1. First you'll have to create a table in your MySQL Database. Look into the
fotos_pics.sql file.
 2. You should upload all files, except for this one and the sql-file.
 3. You should change the standard admin password in .htpasswd and maybe the
RewriteBase in .htaccess and of course the absolute Path in admin/.htaccess.
 4. Open your browser and go to $url. Normally you should get asked for your
admin username and password (admin/nimda). After that you'll see a form with a lot of
configuration options. I hope they are selfexplaining.

4. The future
>Soon there'll be some more features.
