# GIT-Auto-Deploy
GIT Auto deploy auto pull server production to git repositories when you push new update or repositories change.

This repositories can cover all git vendor like bicbucket, github and other. 

Instruction: 

1. Login with root user, create new ssh/rsa key with command "cd /root/.ssh && ssh-keygen -t rsa" and leave password blank (not needed when public repositories) 

2. Copy ssh/rsa key (id_rsa.pub) to git vendor (User Menu -> settings -> SSH at bicbuket or Github) (not needed when public repositories) 

3. Go to repositories settings and add webhooks (Repository Menu -> settings -> Webhooks), add payload/url of web-hook.php from your server (example: yourdomain.com/git-auto-deploy/web-hook.php), select trigers when "Repository push/just the push event". 

4. This repositories need phpseclib repositories (https://github.com/phpseclib/phpseclib)

Tips: for secure access you can rename web-hook.php what ever you want like web-hook-whatever.php (example web-hook-vdgs64sjakdg96fd.php )
