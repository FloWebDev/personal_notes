# Création d'un compte utilisateur SFTP

## Pré-requis

- Avoir **openssh** installé sur son serveur.

Sinon, avec les droits root : `apt-get update && apt-get install openssh-server`

- Toutes les commandes suivantes sont à réaliser avec les droits **root**.

## Création d'un nouvel utilisateur

`adduser --no-create-home usertest`

On ne créé pas tout de suite le répertoire du nouvel utilisateur. On le définira par la suite. On renseigne le mot de passe utilisateur ; et pour les autres informations demandées, on peut laisser tous les champs à vide.

Dans un premier temps, on crée d'abord un répertoire qui regroupera tous les dossiers de l'utilisateur créé. L'interêt de le créer dans ici est de pouvoir lui donner le nom qu'on lui souhaite, celui de l'utilisateur ou un autre.

`mkdir /home/usertest/`

On modifie ensuite le fichier de configuration ssh avec **nano /etc/ssh/sshd_config** :

```
port 22
PermitRootLogin no
[...]
UsePAM yes
[...]
Match user usertest
        ChrootDirectory /home/usertest/
        PermitTunnel no
        X11Forwarding no
        AllowTCPForwarding no
        ForceCommand internal-sftp
```
Le port ssh est le 22 par défaut, mais c'est justement ici que vous pouvez le modifier par sécurité.

Ensuite, on relance le service ssh : `service ssh restart`


A ce stade, afin de pouvoir se connecter en SFTP, il est important de donner les droits sur le répertoire en root pour le *chroot* de la configuration effectuée précédemment.

`chown root:root /home/usertest/`


A ce niveau, le nouvel utlisateur peut se connecter en SFTP mais il ne peut rien écrire ni supprimer. On lui crée donc cette fois-ci un dossier dans lequel il aura tous les droits.


`mkdir /home/usertest/writeable/`

`chown usertest:usertest /home/usertest/writeable/`

`chmod -R 755 /home/usertest/writeable/`


Pour des raison de sécurité, on va interdire l’accès au serveur via SSH pour ce user :

`usermod -s /bin/false usertest`

## Supprimer un utilisateur et tous ses fichiers associés

Pour supprimer un utilisateur et tous les fichiers dont il est propriétaire :

`deluser --remove-all-files usertest`

Si oublie du param **--remove-all-files**, il est possible alors de recréer l'utilisateur avec la commande vue au début, puis de supprimer l'utlisateur avec l'ajout du param (testé et approuvé ;-)).

## Pour consulter le fichier listant la liste de tous les utilisateurs

`nano /etc/passwd`

## Pour modifier le mot de passe d'un utlisateur

`passwd usertest`

Il faut ensuite saisir deux fois le nouveau mot de passe.

### Sources

- SFTP : Accès utilisateur via openssh-server : https://debian-facile.org/doc:reseau:ssh:tp-sftp-via-openssh-server

- Openssh: créer un accès SFTP sur un seul répertoire sous Linux : https://www.le-geek.com/openssh-creer-un-acces-sftp-sur-un-seul-repertoire-sous-linux/

- OpenBSD manual page server : http://man.openbsd.org/sshd_config
