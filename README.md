<p><a href="https://fincra.com" target="_blank"><img src="https://fincra.com/wp-content/uploads/2022/10/fincra-website-logo-colored.png" width="400" alt="Laravel Logo"></a></p>


## About Fincra Wallet System

This is  a basic wallet system that allows for crediting and debiting operations.

## Getting Started
1. Create a `.env` file from the `.env.example` file from the root : Change the `path_to_your_database` from the property value `DB_DATABASE` to your database path
2. Generate a secret key for JWT:

```
php artisan jwt:secret
```

3. Install all dependencies

```
npm install
```

4. Migration - The database seed is provided to have some test data to get started.

```
php artisan migrate --seed

php artisan migrate:refresh --seed

```

5. Starting the app

```
php artisan serve
```

Test Credential for the admin dashboard and API basic auth for generating JWT Token.

```json
{
    "email": "admin@fincra.com",
    "password": "1234"
}
```

Postman Collection for API Testing
```
https://api.postman.com/collections/10263467-b2aeeab3-d020-41be-b38c-04cf5d5cebc4?access_key=PMAT-01HZZB7HY6NWQMJ7BJ58QFYEXK
```

## Technical Documentation
#### Schema Design: Tables and Relationships


##### 1. Users Table

| Column Name | Data Type | Description |
|-------------|------------|-------------|
| `id` | BIGINT(20) UNSIGNED | Primary key, auto-increment. |
| `name` | VARCHAR(255) | User's name. |
| `email` | VARCHAR(255) | User's email address, unique. |
| `password` | VARCHAR(255) | User's hashed password. |
| `created_at` | TIMESTAMP | Timestamp of user creation. |
| `updated_at` | TIMESTAMP | Timestamp of last update. |

##### 2. Wallets Table

| Column Name | Data Type | Description |
|-------------|------------|-------------|
| `id` | BIGINT(20) UNSIGNED | Primary key, auto-increment. |
| `user_id` | BIGINT(20) UNSIGNED | Foreign key referencing the `id` in the `users` table. |
| `balance` | DECIMAL(15, 2) | Current balance of the wallet. |
| `created_at` | TIMESTAMP | Timestamp of wallet creation. |
| `updated_at` | TIMESTAMP | Timestamp of last update. |

##### 3. Transactions Table

| Column Name | Data Type | Description |
|-------------|------------|-------------|
| `id` | BIGINT(20) UNSIGNED | Primary key, auto-increment. |
| `wallet_id` | BIGINT(20) UNSIGNED | Foreign key referencing the `id` in the `wallets` table. |
| `type` | ENUM('credit', 'debit') | Type of transaction. |
| `amount` | DECIMAL(15, 2) | Amount of the transaction. |
| `created_at` | TIMESTAMP | Timestamp of transaction creation. |
| `updated_at` | TIMESTAMP | Timestamp of last update. |


####   Relationships

- **User-Wallet Relationship**: One-to-One (A user has one wallet).
- **Wallet-Transaction Relationship**: One-to-Many (A wallet has many transactions).


#### Libraries and Frameworks
- **Laravel**: Laravel is a PHP framework used for building the backend of the wallet system. It provides a robust set of tools and an expressive syntax that simplifies web development tasks such as routing, authentication, and database migrations.

- **tymon/jwt-auth**: For API authentication. 
- **usmanhalalit/laracsv**: A Laravel package to easily generate CSV files from Eloquent model.

#### Security Measures
1. Input Validation
   Input validation is essential to ensure that the data submitted to the application is valid and safe. Laravel provides a robust validation mechanism that can be used to validate request data before processing it.
```php
$request->validate([
    'wallet_id' => 'required|exists:wallets,id',
    'amount' => 'required|numeric|min:0.01',
]);

```
2. Transaction Safety
   To prevent issues like race conditions, database transactions are used to ensure that multiple related operations are executed atomically. By using lockForUpdate(), we can lock the selected rows to prevent other transactions from modifying them until the current transaction is complete.
```php
DB::transaction(function () use ($request) {
    $wallet = Wallet::lockForUpdate()->find($request->wallet_id);
    $wallet->balance += $request->amount;
    $wallet->save();

    Transaction::create([
        'wallet_id' => $wallet->id,
        'type' => 'credit',
        'amount' => $request->amount,
    ]);
});

```
3. Authentication and Authorization
   Laravel provides built-in authentication mechanisms to secure access to the application. JWT (JSON Web Token) can be used for stateless authentication, ensuring that only authenticated users can access certain endpoints.
```php
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::post('/wallet/credit', [WalletController::class, 'credit']);
    Route::post('/wallet/debit', [WalletController::class, 'debit']);
});

```
4. CSRF Protection
   Laravel automatically generates a CSRF token for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.

### Technical Decisions
#### Schema Design
- **Normalization**: Ensured database normalization to reduce redundancy and improve data integrity.
- **Indexes**: Added necessary indexes for faster query performance on frequently searched columns like user_id and wallet_id.

#### Patterns
**Repository Pattern**: Used for separation of data access logic to keep the codebase clean and maintainable.
