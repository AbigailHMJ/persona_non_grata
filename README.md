#FR - Persona Non Grata
Exercice pédagogique avec le développement d'une application web de création et de partage de fiches de personnages pour rôlistes et écrivain.es.
--
##Table des matières 
#Présentation 
#Fonctionnalités 
#Technologies employées 
#Configuration
#Base de données 
#Upload d'images 
#Tests
#Bonnes pratiques et sécurité
#Contributions et autorisations
-- 
##Présentation /
Persona Non Grata est une application web destinée aux rôlistes et auteurices, sur laquelle vous pouvez des fiches de personnages, de les ajouter dans des campagnes qui peuvent ensuite être partagées à d'autres utilisateurs. 

##Fonctionnalités /
- Inscription
- Connexion
- Création de fiches de personnage
- Création de campagnes
- Partage de campagnes
- Ajout de liens externes aux fiches (playlists...)
- Ajout de genres à une campagne (fantastique, contemporain...)
- Upload d'images

##Technologies employées /
- PHP 8.4
- Symfony, Doctrine
- Twig (templates)
- Composer
- PHPUnit (tests)
- JavaScript (vanilla)
- SASS
- HTML

##Configuration
# Cloner le dépôt
git clone https://github.com/AbigailHMJ/persona_non_grata
cd persona_non_grata
# Installer les dépendances PHP
composer install
# Installer les dépendances front-end si besoin
composer require symfonycasts/sass-bundle
# Copier les fichiers
.env : cp .env .env.local
# Editer le fichier .env pour modifier les variables d'environnement : DATABASE_URL & APP_SECRET
# Optionnel : configurer les paramètres d'images dans services.yaml 
parameters:
        uploads_directory: '%kernel.project_dir%/public/uploads'

##Base de données
Créer la base de données et exécuter les migrations / Create database and execute migrations:
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

##Upload d'images
- Le formulaire de création de personnage permet d'ajouter une illustration / Character creation form let you add an illustration
- Le fichier ajouté est renommé (slug, uniqid), converti en .webp et déplacé dans le dossier uploadscharacter (public/uploadscharacter) / Added file is renamed (slug, uniqid), converted in .webp and moved to folder uploadscharacter (public/uploadscharacter)

##Tests
Tests unitaires 
Exécuter PHPUnit : php bin/phpunit

##Bonnes pratiques et sécurité
- Contraintes de fichiers uploadés avec MIME
- Contraintes de formulaires sur la longueur minimale requise (mot de passe notamment)

##Contributions et autorisations
Vous pouvez contribuer à ce dépôt ! 
N'oubliez pas de créer votre propre branche et de documenter vos modifications.
Amusez-vous !

#EN - Persona Non Grata
Educational exercise developping a web application for creating and sharing character sheets, for roleplayers and authors.
--
##Table of contents
#Presentation
#Functions
#Used technologies
#Configuration
#Database
#Pictures uploading
#Tests
#Good practices and security
#Contributions and authorisations
-- 
##Presentation
Persona Non Grata is a web application destined to roleplayers and authors, on which you can create character sheets, add them to campaigns that can then be shared with other users.

##Functionnalities
- Inscription
- Connection
- Creation of character sheets
- Creation of campaigns
- Sharing of campaigns
- Adding of external links to the sheets (playlists...)
- Adding of genres to a campaign (fantasy, contemporary...)
- Pictures upload

##Used technologies
- PHP 8.4
- Symfony, Doctrine
- Twig (templates)
- Composer
- PHPUnit (tests)
- JavaScript (vanilla)
- SASS
- HTML

##Configuration
# Clone depot:
git clone https://github.com/AbigailHMJ/persona_non_grata
cd persona_non_grata
# Install PHP dependencies:
composer install
# Install front-end dependencies if needed:
composer require symfonycasts/sass-bundle
# Copy files
.env : cp .env .env.local
# Edit .env file to modify environment variables: DATABASE_URL & APP_SECRET
# Optional: configure pictures paramters in services.yaml:
parameters:
        uploads_directory: '%kernel.project_dir%/public/uploads'

##Database
Create database and execute migrations:
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

##Pictures uploading
- Character creation form let you add an illustration
- Added file is renamed (slug, uniqid), converted in .webp and moved to folder uploadscharacter (public/uploadscharacter)

##Tests
Tests unitaires 
Execute PHPUnit : php bin/phpunit

##Good practices and security
- File constraints with MIME
- Form constraints for minimal required length of form fields (notably the password)

##Contributions and authorisations
You can contribute to this depot !
Don't forget to create your own branch and document your modifications.
Have fun!

##Contact
Une question ? un retour ? 
Vous pouvez me contacter à l'adresse abigail.jean2@gmail.com
A question? some feedback?
You can reach me at abigail.jean2@gmail.com
