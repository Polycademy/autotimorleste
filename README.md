Auto Timor Leste Official Site
==============================

Official site of Auto Timor Leste - Toyota Timor Leste (http://autotimorlestetoyota.com)

Deploy
-----

Add Pagoda Remote. Push to Pagoda. (Make sure your SSH key is added to Pagodabox.)

```
git remote add pagoda git@git.pagodabox.io:apps/autotimorleste.git
git push pagoda --all
```

Make sure both Network Storage and Database Service have SSH enabled.

Post Deploy Synchronisation
---------------------------

1. Filesystem Synchronisation:
   
   Download the current state of uploads.

   ```
   rsync -chavzP --stats --rsh='ssh -p2768' gopagoda@remote:~/data/wp-content/uploads/ /path/to/local/wp-content/uploads/
   ```

   Upload the current state of uploads.

   ```
   rsync -chavzP --stats --rsh='ssh -p2768' /path/to/local/wp-content/uploads/ gopagoda@remote:~/data/wp-content/uploads/
   ```

   Upload the current secrets.

   ```
   rsync -chavzP --stats --rsh='ssh -p2768' /path/to/local/secrets/ gopagoda@remote:~/data/secrets/
   ```
   
2. Database Synchronisation:

   Wordpress database migration plugin via Tools > Migrate DB. From the current address, add the remote address domain **but without the trailing slash**. For example:

   ```
   #From Local to Remote:
   http://localhost/autotimorleste -> http://autotimorleste.gopagoda.io
   #From Remote to Local:
   http://autotimorleste.gopagoda.io -> http://localhost/autotimorleste
   ```

   The New File Path is irrelevant, it can be left as '/'. Don't replace GUIDs once the site is live. 

   We can now upload the database export. First we need to establish a SSH tunnel to local database instance (get the IP and remote from the database instance on the dashboard).

   ```
   ssh gopagoda@remote -p 2806 -N -L :3306:IP:3306
   ```

   Then connect to the database on port `localhost:3306`.

   Use the correct database name. Load the exported SQL.

Notes
-----

Shortcodes such as tables, buttons and accordions can be found here: http://wp-demo.indonez.com/Tucana/shortcodes/