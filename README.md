# Projekt Dokumentation

## Vorbereitung
  ``` bash
  mkdir -p jobboerse/skizzen && cd jobboerse
  git init
  ```

## Aufgabe 1 - Konzept
- Diagramme erstellt (siehe ./skizzen)

## Aufgabe 2 - Laravel Projekt erstellen
### Resourcen
- [Laravel Installation](https://laravel.com/docs/11.x/installation)

### Umsetzung
  ``` bash
  composer create-project laravel/laravel jobportal
  cd jobportal
  php artisan serve
  ```
- localhost:8000 zeigt erfolgreich Testseite

## Aufgabe 3
### Resourcen
- [Laravel Eloquent](https://laravel.com/docs/11.x/eloquent)
- [Stack Overflow: Laravel Model, Controller, Migration](https://stackoverflow.com/questions/43187735/laravel-create-model-controller-and-migration-in-single-artisan-command)
- [Laravel Migrations](https://laravel.com/docs/11.x/migrations)
- [Laravel Seeding](https://laravel.com/docs/11.x/seeding)
- [Laravel Eloquent Factories](https://laravel.com/docs/11.x/eloquent-factories)

### Umsetzung
- Auf Problem gestoßen:
  - Laravel erzeugt in seinem Standardsetup selbst eine 'jobs' Tabelle
  - Umbenennung von Model 'Job' in 'Position'
  ``` bash
  php artisan make:model Position -a
  php artisan make:model Company -a
  php artisan make:model Category -a
  php artisan make:migration add_role_to_users_table --table=users
  ```
  - $table->enum('role', ['standard', 'company', 'admin'])->default('standard');
- User Model bearbeitet:
  - 'role' unter 'fillable' ergänzt
  - Methoden zum späteren Prüfen der Rollen erzeugt

#### Seeds erstellen
- config/app.php: Faker local auf 'de_DE' geändert
  ``` bash
  php artisan db:wipe 
  php artisan migrate
  php artisan db:seed
  ```
- Category, Company, PositionFactory mit Faker eingerichtet
- UserFactory um Methode 'company' ergänzt, um diese in Company und PositionFactory zu nutzen
- Seeder eingerichtet
- Company und PositionFactory bearbeitet, um sicherzustellen, dass ein User mit 'role' 'company' gewählt oder erzeugt wird
- 'faker' verwenden, nicht 'fake'
- In den Factorys 'use App\Models\MODEL' ergänzt
- Die erstellten Seeder aus 'DatabaseSeeder' aufrufen
- Nach Problemen durch nur teilweise erzeugte DB-Strukturen:
    ``` bash
    php artisan migrate:refresh --seed
    php artisan db:seed --class=PositionSeeder
    ```

##### Manuelle Tests
  ``` bash
  php artisan tinker
  DB::connection()->getPdo();
  App\Models\Company::all();
  DB::select('SELECT # FROM companies');
  DB::table('companies')->where('name', 'like', '%rolfson%')->first(); // Mehr Optionen sieht man ohne first()
  App\Models\Company::find(1); // Findet die Firma mit der ID 1
  App\Models\Company::create([
      'name' => 'Testfirma',
      'address' => 'Musterstraße 123',
      'email' => 'kontakt@testfirma.de',
    ]); // oder:
  $company = new App\Models\Company;
      $company->name = 'Neue Firma GmbH';
      $company->address = 'Beispielweg 456';
      $company->email = 'info@neuefirma.de';
      $company->save();
  ```

## Aufgabe 4 - Views, Controller Actions, Routes
### Resourcen
- [Laravel Views](https://laravel.com/docs/11.x/views)
- [A Coding Project: Laravel Views](https://www.a-coding-project.de/ratgeber/laravel/views)
- [DigitalOcean: Simple Laravel CRUD with Resource Controllers](https://www.digitalocean.com/community/tutorials/simple-laravel-crud-with-resource-controllers)
- [Medium: Simple Laravel CRUD with Resource Controllers](https://medium.com/@santoshbusiness108/simple-laravel-crud-with-resource-controllers-95fb9f7ffab1)
- [Laravel Validation](https://laravel.com/docs/11.x/validation)
- [Dev.to: Simple Nav Bar with Laravel and Bootstrap](https://dev.to/hamidatjajiga/make-a-simple-nav-bar-with-laravel-and-bootstrap-433j)
- [Laravel Authentication](https://laravel.com/docs/11.x/authentication)
- [Laravel Starter Kits](https://laravel.com/docs/11.x/starter-kits)
- [Laravel Blade](https://laravel.com/docs/11.x/blade)
- [Laravel CSRF](https://laravel.com/docs/11.x/csrf)
- [Laravel Routing](https://laravel.com/docs/11.x/routing#form-method-spoofing)
- [Laravel Authorization: Creating Policies](https://laravel.com/docs/11.x/authorization#creating-policies)
- [Medium: Laravel 11 Policies](https://medium.com/@umerfayyaz500/laravel-11-policies-and-secure-your-app-with-policy-driven-authorization-77759459888f)
- [Stack Overflow: Use Flash Message in Blade Template](https://stackoverflow.com/questions/57882083/use-flash-message-in-blade-template)

### Positions
- index und create erstellt
- Bei 'store' war [Laravel Validation](https://laravel.com/docs/11.x/validation) besonders hilfreich, 'update' analog
  ``` bash
  php artisan route:list
  ```
- Routen für alle drei Entitäten erstellt
- 'positions/index.blade.php' erstellt und erfolgreich aufgerufen
- 'app.blade.php' erstellt, inkl. Bootstrap, Bootstrap Navbar; Einbindung in View
- 'create' View erstellt: Problem mit Routen erkannt und gelöst
- 'csrf' Token zu 'create' und 'edit' hinzugefügt
- Method Spoofing in 'edit' eingeführt

### Companys
- Controller Actions erstellt
- Store ermöglichen: [Stack Overflow: Errors this action is unauthorized](https://stackoverflow.com/questions/47128903/errors-this-action-is-unauthorized-using-form-request-validations-in-laravel#47129765)
  - Mit 'app\http\requests' befassen (auch 'update')
- Nach Registrierung als Company redirect auf 'companys.create'

### Categorys
- MVC am Beispiel von Positions und Companys ohne Probleme erstellt

### User Authentication
#### Starter Kit
  ``` bash
  composer require laravel/breeze --dev
  php artisan breeze:install
  npm install
  npm run dev
  ```
- Hat meine 'app.blade.php' überschrieben
- Views an Breeze angepasst und 'app.blade.php' um Bootstrap ergänzt
- Registrierungslink auf Loginseite hinzugefügt
- Radio Button zu Registrierung hinzugefügt, um zwischen 'role' 'standard' und 'company' zu wählen
- 'RegisteredUserController' angepasst ('role' hinzugefügt)

### Weitere Schritte 
- Fehlerausgabe in Formulare eingefügt
- UpdateRequests erzeugt
- Delete Policies für Company und Position erzeugt und angewandt (mit Gate)
- Auswahl von Kategorie bei der Anzeigen Erstellung hinzugefügt; 'show' angepasst; Controller angepasst
- Nach Login Redirect auf 'positions.index'
- Erzwinge Backendseitig, dass ein 'company' User nur eine Firma erstellen kann (in #store)
- Alle Policies in Controllern verknüpft und in Views angewandt (um nur gültige Links anzuzeigen); Policies in 'AppServiceProvider' registriert
- Flashmessages anzeigen ('app.blade.php')
- Pagination hinzugefügt
- Nach neuestem Änderungsdatum sortieren
- Feature: Unter 'categorys.show': Liste von Jobs aus dieser Kategorie mit Link zu ihnen
- Refactoring und Kommentieren
- Authentication middleware auf alle Routen
- config/app.php bearbeitet

