# Routes

| URL | Méthode HTTP | Controller | Méthode | Titre | Contenu | Commentaire |
|--|--|--|--|--|--|--|
| `/` | `GET || POST` | `MainController` | `home` | Dans les shoe | 5 catégories | - |
| `/mentions-legales/` | `GET || POST`  | `MainController` | `legalMentions` | Mentions Légales | Paragraphes sur les mentions légales | - |
| `/catalogue/categorie/[id]` | `GET || POST`  | `CatalogController` | `category` | #Nom de la catégorie# | Liste des produits de la catégorie | `[id]` correspond au champ `id` de la catégorie en BDD |