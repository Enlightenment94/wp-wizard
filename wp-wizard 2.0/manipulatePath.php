Zaminpuluj ścieżkami przy pomocy wtyczki wp hide ghost lub sam w pliku .htaccess.
<pre>

# BEGIN WordPress
# Dyrektywy zawarte między "BEGIN WordPress" oraz "END WordPress"
# są generowane dynamicznie i powinny być modyfikowane tylko za pomocą
# filtrów WordPressa. Zmiany dokonane bezpośrednio tutaj będą nadpisywane.

<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

#Proste przekierowanie na google.com
#RewriteRule ^newlogin$ http://www.google.com [R,L]

# Zablokowanie dostępu do pozostałych plików wp-login.php
# odczyt pod ściezką newlogin zablokowanie pod wp-login.php
RewriteRule ^newlogin$ /wp-login.php [L,QSA]
RewriteCond %{THE_REQUEST} ^[A-Z]{3,}\s/wp-login.php [NC]
RewriteRule ^wp-login.php$ - [F]

#RewriteRule . /index.php [L]
</IfModule>

# END WordPress
	
</pre>