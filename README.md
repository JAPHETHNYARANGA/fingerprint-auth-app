# Introduction
This is a simple authentication application that uses an email, name , password and a user's fingerprint.

# Features
The main features of this application is registering a users name, email, password and fingerprint, then logging in the user using either the email and password or the fingerprint only.

# Prerequisites.
* Laravel 11
* PHP ^8.0"

# ThirdParty Libraries
* Bootstrap
* FingerprintJS v4.2.1

# Installation
* `git clone https://github.com/JAPHETHNYARANGA/fingerprint-auth-app.git`
* `cd project-directory`
* `composer install`
* `create environment file in the root folder `
* `php artisan key:generate`
* `php artisan migrate`
* `php artisan serve`

# Testing
To run the test cases for th application, just run 
`php artisan test`
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Screenshots
![alt text](<Screenshot from 2024-03-06 23-07-46.png>)

![alt text](<Screenshot from 2024-03-06 23-11-02.png>)
