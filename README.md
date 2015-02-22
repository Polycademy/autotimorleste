Auto Timor Leste Official Site
==============================

Official site of Auto Timor Leste - Toyota Timor Leste

Deploy
-----

Add Pagoda Remote. Push to Pagoda.

```
git remote add pagoda git@git.pagodabox.io:apps/autotimorleste.git
git push pagoda --all
```

Post Deploy Synchronisation
---------------------------

1. Filesystem Synchronisation:
   
   Download the current state of uploads.

   ```
   rsync -chavzP --stats user@remote:/path/to/remote/wp-content/uploads /path/to/local/wp-content/uploads
   ```

   Upload the current state of uploads.

   ```
   rsync -chavzP --stats /path/to/local/wp-content/uploads user@remote:/path/to/remote/wp-content/uploads
   ```

   Upload the current secrets.

   ```
   rsync -chavzP --stats /path/to/local/secrets user@remote:/path/to/remote/secrets
   ```
   
2. Database Synchronisation:

   Wordpress database migration plugin via Tools > Migrate DB. From the current address, add the remote address domain **but without the trailing slash**. For example:

   ```
   #From Local to Remote:
   http://localhost/autotimorleste -> http://autotimorleste.gopagoda.com
   #From Remote to Local:
   http://autotimorleste.gopagoda.com -> http://localhost/autotimorleste
   ```

   The New File Path is irrelevant, it can be left as '/'. Don't replace GUIDs once the site is live. Upload the database export. It works even when the tables still exist. You can connect to the database via ssh tunnelling (http://help.pagodabox.com/customer/portal/articles/175427).

   ```
   pagoda tunnel -c db1
   autotimorleste
   ```

Notes
-----

Shortcodes such as tables, buttons and accordions can be found here: http://wp-demo.indonez.com/Tucana/shortcodes/