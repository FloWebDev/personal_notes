# Dictionnaire de données

## Entité Role (`role`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
| id | INT (11)| PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant du role |
| code | VARCHAR(32) | NOT NULL | Référence du rôle |
| name | VARCHAR(32) | NOT NULL | Intitulé du rôle |

## Entité User (`app_users`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
| id | INT(11) | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de l'utilisateur |
| username | VARCHAR(25) | NOT NULL, UNIQUE | Identifiant de l'utilisateur |
| password | VARCHAR(64) | NOT NULL | Mot de passe de l'utilisateur |
| email | VARCHAR(254) | NOT NULL, UNIQUE | Email de l'utilisateur |
| firstname | VARCHAR(32) | NULL | Prénom de l'utilisateur |
| lastname | VARCHAR(32) | NULL | Nom de l'utilisateur |
| is_active | BOOLEAN | NOT NULL, DEFAULT 'true' | Statut de l'utilisateur |

## Entité Question (`question`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
| id | INT (11)| PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de la question |
| title | VARCHAR(256) | NOT NULL | Intitulé de la question |
| body | TEXT | NOT NULL | Corps de la question |
| nb_like | INT | NOT NULL, DEFAULT 0 | Nombre de votes pour la question |
| is_active | BOOLEAN | NOT NULL, DEFAULT 'true' | Statut de la question |
| created_at | DATETIME | NOT NULL, DEFAULT CURRENT_TIMESTAMP | Date de création de la question |
| updated_at | DATETIME | NULL | Date de la dernière mise à jour de la question |
