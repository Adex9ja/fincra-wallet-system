<p align="center"><a href="https://fincra.com" target="_blank"><img src="https://fincra.com/wp-content/uploads/2022/10/fincra-website-logo-colored.png" width="400" alt="Laravel Logo"></a></p>


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
