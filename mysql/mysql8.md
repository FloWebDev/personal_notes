# Notes sur l'installation de MySQL 8

## Désinstaller MySQL et sa configuration

> sudo apt purge mysql-*

> sudo rm -fr /etc/mysql /var/lib/mysql*

> sudo apt autoremove

> sudo apt autoclean

## Installer MySQL

Aller ce sur lien [dev.mysql](https://dev.mysql.com/downloads/repo/apt/) et copier le lien du téléchargement.

Ensuite :

> wget https://dev.mysql.com/get/mysql-apt-config_0.8.15-1_all.deb

> sudo dpkg -i mysql-apt-config_0.8.15-1_all.deb

Valider la version souhaitée (sur la 1ère ligne normalement), puis valider ensuite OK.

> sudo apt update

> sudo apt install mysql-server


Entrer un mot de passe pour l'utlisateur **root** et le confirmer.

L'installation demande ensuite de sélectionner le plugin d'authentification par défaut : 
1. Use Strong Password Encryption (RECOMMENDED) 
2. Use Legacy Authentication Method (Retain MySQL 5.x Compatibility) 

Si la première option est recommandée car plus sécurisée, j'ai constaté qu'elle pouvait engendrer des problèmes d'autentification pour se connecter à phpMyAdmin.

Pour y remédier, j'ai dû :
* Modifier le mot de passe de root pour que celui-ci soit au moins d'une taille de 8 caractères, avec lettres (minuscules et majuscules), chiffres et caractères spéciaux.
* Dans MySQL, exécuter le requête : `ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'New_password01!';`
* sudo dpkg-reconfigure mysql-server

Je n'ai pas beaucoup analysé ce qui engendre ce problème d'authentification mais j'ai au final effectuer une nouvelle installation de MySQL en sélectionnant le second choix, moins sécurisé mais avec semble t-il moins de problèmes d'authentification et une meilleure compatibilité avec MySQL 5.x et les clients MySQL plus anciens).

**EDIT :** *Il semble toutefois que ce soit la seconde ligne (ALTER...) qui est permis de solutionner le problème, même sans complexifier le mot de passe. (probablement lié à la méthode d'authentification mysql_native_password).*

> sudo mysql_secure_installation

Il s'agit d'installer un script de sécurité pour MySQL. Au niveau de l'installation, sauf raison particulière, il est possible de simplement répondre Yes à toutes les questions.

Pour vérifier le statut de MySQL : `sudo systemctl status mysql`

Enfin, pour se connecter à MySQL

> mysql -u root -p

## Installer phpMyAdmin

Depuis ce lien [phpMyAdmin](https://www.phpmyadmin.net/), copier le lien de téléchargement de phpMyAdmin.

Ensuite :

> wget https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-all-languages.zip

> unzip phpMyAdmin-5.0.2-all-languages.zip 

Renommer le nom du dossier par celui que vous souhaitez, puis :
* soit vous êtes sur un serveur dans lequel il y a un file-system, ce qui est le cas avec Apache par défaut (ce qui peut être le cas avec Nginx aussi, mais il faut alors le configurer), dans ce cas il suffit d'aller par exemple sur http://localhost/phpmyadmin si vous avez renommé le dossier en *phpmyadmin*.
* soit vous n'êtes pas en file system (par exemple avec Nginx), dans ce cas il faudra créer un VHOST qui pointe sur ce dossier renommé.

### Gérer la configuration et les erreurs de phpMyAdmin

Commencer par copier/coller le fichier de configuration en le renommant.

> cp config.sample.inc.php config.inc.php

Puis modifier la ligne `$cfg['blowfish_secret'] = '';` pour y ajouter un mot de passe encrypté (utliser un générateur en ligne si besoin).

Il y aura aussi probablement l'erreur (ou similaire) : `$cfg['TempDir'] (/var/www/html/phpmyadmin/tmp/) n'est pas accessible. phpMyAdmin est incapable de mettre en cache les modèles et de ce fait sera lent.`

Il convient de créer le dossier *tmp* dans et de donner les droits à **www-data** pour ce dernier (chown et chmod selon besoin).

Si message suivant (ou équivalent) :

`Le stockage de configurations phpMyAdmin n'est pas complètement configuré, certaines fonctionnalités ont été désactivées. Voir l'analyse du problème.
Ou encore aller sur l'onglet « Opérations » de n'importe quelle base de données pour le définir à cet endroit.`

Il convient de se placer à la racine phpMyAdmin (sans avoir sélectionné préalablement une base), puis cliquer sur le lien proposé pour *créer une base de données nommée « phpmyadmin » et la configuration du stockage de phpMyAdmin dans cette base.*
