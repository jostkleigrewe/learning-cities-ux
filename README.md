# Installation

Symfony installieren

````bash
symfony new cities-ux --version="7.3.*" --webapp
````

Symfony UX installieren

````bash
composer require symfony/ux-turbo symfony/stimulus-bundle
````

Externe JS/CSS Pakete / Assets installieren

````bash
php bin/console importmap:install
````


````bash
php bin/console importmap:require @hotwired/stimulus
php bin/console importmap:require @hotwired/turbo
````

Tabler installlieren

````bash
php bin/console importmap:require @tabler/core
````

Dann in assets/app.js einfügen:
````js
import '@tabler/core/dist/js/tabler.min.js';
````





