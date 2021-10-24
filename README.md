<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About mini-aspire API application

This project is using Laravel is a web application framework with expressive, elegant syntax to build a mini-aspire API.

It is an app that allows authenticated users to go through a loan application. It doesn’t have to contain too many fields, but at least “amount
required” and “loan term.” All the loans will be assumed to have a “weekly” repayment frequency.

After the loan is approved, the user must be able to submit the weekly loan repayments. It can be a simplified repay functionality, which won’t
need to check if the dates are correct but will just set the weekly amount to be repaid.

## Getting Started
- Clone the repo
- Clone the .env.example then rename to .env
### Using Docker to set up
The project is configurated to run with docker by using the [Laravel Sail](https://laravel.com/docs/8.x/sail#introduction).

First, you need to run composer install command line if you have the completed PHP CLI and composer setup on your local.

Otherwise, you could install composer dependencies for this existing application by following this [Laravel Sail guideline](https://laravel.com/docs/8.x/sail#installing-composer-dependencies-for-existing-projects).

After installing the composer dependencies, following this [Configuring A Bash Alias](https://laravel.com/docs/8.x/sail#configuring-a-bash-alias) to run `sail` command lines.

### Configuration
After the application is up, we need to run migration and seed script to create table and sample data
- If you are using sail, you need to run this command:
`sail artisan migrate:refresh --seed`
- Otherwise, you could use the normal laravel migration command line: `php artisan migrate:refresh --seed` but just make sure the application is able to connect to your database following the settings in `.env`file.

## Usage
Import `mini-aspire.postman_collection.json` to your postman.
You might need to update the `APP_URL` collection variable to your URL localhost.

The application provides 8 APIs:
- Login
- Logout
- Add LoanApplication
- List LoanApplication
- Get LoanApplication
- Approve LoanApplication
- Add LoanRepayment

### Sample user data
There are 2 user types:
- Approver user (2 sample records) - `approver1` and `approver2`
- Normal user (2 sample record) - `user1` and `user2`

All user has the same password as `123`

### Authentication
The application is using a session guard which maintains state using session storage and cookies which is shipped by [Laravel Authentication](https://laravel.com/docs/8.x/authentication#introduction) to authenticate a user
and [Laravel Sanctum](https://laravel.com/docs/8.x/sanctum#spa-authentication) to be the SPA authentication approach which uses Laravel's built-in cookie based session authentication services.
This approach to authentication provides the benefits of CSRF protection, session authentication, as well as protects against leakage of the authentication credentials via XSS.

### Authorization
The application is using [Policies](https://laravel.com/docs/8.x/authorization#creating-policies) feature to make following restriction rules:
- Only approver user can list all loan application or view any loan application
- Only normal user can add a loan application
- Only approver user can approve a loan application which is not approved yet
- Normal user can only view his/her own loan application
- Only owner of a loan application can submit the weekly loan repayments for it and this loan application is not fully located yet

### Validation rules
The application is using [Form Request Validation](https://laravel.com/docs/8.x/validation#creating-form-requests) to build validation rules on loan application and loan repayment resources.
- The `amount_required` and `loan_term_by_week` are required fields
- Date format `Y-m-d` for `approved_date` and `repayment_date`. If this field is not provided, the current date is used

### Eloquent: API Resources
The application is using [Eloquent: API Resources](https://laravel.com/docs/8.x/eloquent-resources) to be a transformation layer that sits between Eloquent models and the JSON responses that are actually returned to application's users.

### Scenario
- Login as user1: `{"name": "user1", "password": "123"}` => 200 OK | UserResource
- Add LoanApplication: `{"amount_required": 1000, "loan_term_by_week": 2}` => 201 Created | LoanApplicationResource
- Approve LoanApplication as user1 (normal user), use the id from response above: => 403 Forbidden
- Login as approver1: `{"name": "approver1", "password": "123"}` => 200 OK | UserResource
- Approve LoanApplication as approver1 (approver user), use the id from the 2nd response above => 200 OK | LoanApplicationResource
- Add LoanRepayment as approver1 (approver user), use the id from the 2nd response above => 403 Forbidden
- Login as user1: `{"name": "user1", "password": "123"}` => 200 OK | UserResource
- Add LoanRepayment as user1 (normal user), use the id from the 2nd response above => 201 Created | LoanRepaymentResource
- Add LoanRepayment as user1 (normal user), use the id from the 2nd response above => 201 Created | LoanRepaymentResource
- Add LoanRepayment as user1 (normal user), use the id from the 2nd response above => 403 Forbidden due to the loan application is fully located
