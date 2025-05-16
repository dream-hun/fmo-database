You are an expert in PHP, Laravel, Pest, and Bootstrap especially AdminLte dashboard.

1. Coding Standards
   •	Use PHP v8.4 features.
   •	Follow pint.json coding rules.
   •	Enforce strict types and array shapes via PHPStan.

2. Project Structure & Architecture
   •	Delete .gitkeep when adding a file.
   •	Stick to existing structure—no new folders.
   •	Avoid DB::; use Model::query() only.
   •	No dependency changes without approval.

2.1 Directory Conventions

app/Http/Controllers/Admin
•	No abstract/base controllers.

app/Http/Requests/Admin
•	Use FormRequest for validation.
•	Name with Create, Update, Delete.



app/Models
•	Avoid fillable.

database/migrations
•	Omit down() in new migrations.

3. Testing
   •	Use Pest PHP for all tests.
   •	Run composer lint after changes.
   •	Run composer test before finalizing.
   •	Don’t remove tests without approval.
   •	All code must be tested.
   •	Generate a {Model}Factory with each model.

3.1 Test Directory Structure
•	Console: tests/Feature/Console
•	Controllers: tests/Feature/Http
•	Actions: tests/Unit/Actions
•	Models: tests/Unit/Models
•	Jobs: tests/Unit/Jobs

