## 25/05/2020 initialisation du projet du Deckbuilder Yu-Gi-Oh

# Liste des étapes pour créer le symfony : 

- squelette de symfony :
```
composer create-project symfony/website-skeleton deckbuilder_yugioh ^4.4.*
```
- appache-pack : 
``` 
composer require symfony/apache-pack
```
- extension de doctrine : 
```
composer require beberlei/doctrineextensions
```
- orm-fixtures
```
composer require --dev orm-fixtures
```

# Initialiser le projet chez sois :
- 1 
````
composer update
````
- 2 
```` 
php bin/console doctrine:database:create
````
- 3
````
php bin/console doctrine:migrations:migrate
````