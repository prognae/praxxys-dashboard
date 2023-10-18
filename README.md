**Step by step process on how to run the dashboard application**

1. Clone the repository so you can get all the needed files.
2. After cloning, open the terminal and navigate to the cloned repository.
3. Run 'composer update' to initialize laravel in the application.
4. Run 'npm install' to get all the required npm libraries and packages.
5. Navigate and rename .env.example to .env so it can become your environtment variables.
6. In the terminal, run 'php artisan key:generate' to initialize your unique app key in the .env file.
7. In the .env file, update your database configuration so all migrations can be present in your desired database.
8. In the terminal, run 'php artisan migrate' to migrate all tables from the app to your local database.
9. Congratulations! You can now run the laravel application. Run 'npm run dev' and 'php artisan serve' in the terminal and you are all set.
10. **The database has no records now but you can create some by registering users or using database seeders. You can run 'php artisan db:seed --class=AdminSeeder' for generating default users or you can create multiple items using 'php artisan db:seed --class=ProductSeeder' which creates 10 items every time you run the command.**
