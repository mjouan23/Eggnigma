# Chasse aux œufs - Laravel

Application mobile-first pour une chasse aux œufs via QR Code.

## Objectif
- Scanner un QR Code qui pointe vers `/enigme/{code}`
- Afficher une énigme dans l'application
- Ajouter automatiquement l'œuf trouvé à la page d'accueil
- Utiliser Laravel, Blade, Bootstrap et du JavaScript simple

## Structure
- `routes/web.php` : routes publiques
- `app/Models/Egg.php` : modèle de l'œuf / énigme
- `app/Http/Controllers/HomeController.php`
- `app/Http/Controllers/EggController.php`
- `resources/views/layouts/app.blade.php`
- `resources/views/home.blade.php`
- `resources/views/egg/show.blade.php`
- `public/js/egg-hunt.js`
- `database/migrations/2026_03_31_000000_create_eggs_table.php`
- `database/seeders/EggSeeder.php`
- `database/seeders/DatabaseSeeder.php`

## Installation
1. Installer Laravel dans le dossier de travail :
   ```bash
   composer create-project laravel/laravel .
   ```
2. Copier les fichiers créés dans ce répertoire.
3. Configurer la base MySQL dans `.env` :
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=eggnigma
   DB_USERNAME=your_user
   DB_PASSWORD=your_password
   ```
4. Exécuter les migrations et le seed :
   ```bash
   php artisan migrate --seed
   ```
5. Lancer le serveur :
   ```bash
   php artisan serve
   ```

## Utilisation
- Chaque QR Code doit pointer vers une URL comme :
  `https://mon-site.fr/enigme/MWZSD`
- Quand le participant ouvre la page, le code est stocké localement
  dans le navigateur et la page d'accueil liste les œufs trouvés.

## Notes
- Le stockage des découvertes se fait côté client avec `localStorage`.
- Pour empêcher les triches, le code est unique et non indexé publiquement.
