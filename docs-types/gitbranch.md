# Créer et merger une branche
1) `git branch`

• master (là où nous sommes)

2) `git branch <newbranch>`

newbranch

• master

3) `git checkout <newbranch>`

• newbranch

master

`On peut maintenant coder sur la branche nouvellement créée.`

4) `git status` (pour éventuellement vérifier si du code est à valider dans la branche)

5) `git add .`

6) `git commit -m "<commentaire associé au code de la branche>"`

7) `git push` => Git renvoie un message d'erreur : "Pour pousser la branche courante et définir la distante comme amont, utilisez : `git push --set-upstream origin <newbranch>`

8) `git push --set-upstream origin <newbranch>`

9) `git checkout master` : pour retourner sur la branche principale. A ce niveau là, nous n'avons plus le code codé sur la nouvelle branche (normal).

• master

newbranch

10) `git merge <newbranch>` On se positionne sur master pour fusionner la nouvelle branche et on récupère le code de la nouvelle branche (normalement, même pas besoin de git pull à ce niveau là).

## En complément

`git branch -a` pour voir toutes les branches (en local **et** à distance)

`git branch -d <branch>` pour supprimer une branche en local
