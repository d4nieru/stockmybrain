## A propos de Stock My Brain

**Stock My Brain** est un **outil de gestion de projet** en ligne qui repose sur l'**organisation des projets en tableaux** répertoriant des cartes, chacune représentant des tâches.

**Fonctionnalités :**

- **Créer un ou plusieurs espaces de travail**<br>
↘️ *Possibilité d'ajouter une image de couverture.*<br>
↘️ *Possibilité de changer le nom de l'espace de travail.*<br>

- **Créer un ou plusieurs tâches**<br>
↘️ *Possibilité de changer le nom de la tâche.*<br>
↘️ *Possibilité de changer la description de la tâche.*<br>
↘️ *Possibilité de choisir l'importance de la tâche.*<br>
↘️ *Possibilité de changer l'etat de la tâche.*<br>

## Pré-requis

- Un **Environnement de développement** (on vous conseille **[VSCode](https://code.visualstudio.com)**)<br>
- Un **Serveur Web** (en local, on vous conseille fortement **[Laragon](https://laragon.org/download/index.html)** pour éviter le maximum de soucis, malgré qu'il en existe d'autres tels que XAMPP, WAMP)
- **[PHP](https://windows.php.net/download)** Version 8.2+ (Thread Safe) (le chemin du dossier **PHP** se trouve dans `\laragon\bin\php`)

## Installation

1. Ouvrez le terminal (ou powershell) à l'endroit que vous voulez que le dossier du projet soit 
>Maintenez le bouton SHIFT et clic droit **(en meme temps)** à l'endroit où vous voulez que le dossier du projet soit, vous verrez "Ouvrir la fenetre powershell ici"

et tapez la commande suivante :

> `git clone https://github.com/d4nieru/stockmybrain.git`
2. Ouvrez le dossier du projet avec votre environnement de développement, puis ouvrez le terminal et tapez la commande suivante :
> `composer install`
3. Copiez collez le fichier **.env.example** et le renommer simplement en **.env**

4. Tapez la commande suivante :
> `php artisan key:generate`

5. Dans le fichier **.env**, configurez ces champs pour permettre la connexion vers la base de données :

`DB_CONNECTION=mysql`
`DB_HOST=127.0.0.1`
`DB_PORT=3306`
`DB_DATABASE=...`
`DB_USERNAME=...`
`DB_PASSWORD=...`

6. Tapez dans le terminal du projet la commande suivante :
> `php artisan migrate` et **assurez que tout soit bien passé**
> 
> (exemple d'une migration effectuée avec succès) :

7. Lancez le projet en faisant la commande suivante :
> `php artisan serve`



## License

Stock My Brain est un projet open source soumis à la license [GNU v3.0](https://opensource.org/license/gpl-3-0/).
