# Coder71

To run this project, you need to have PHP, Composer, and MySQL installed on your machine.
Also, you need to have a web server like Apache or Nginx installed on your machine.

To begin, run the following command to download the project using Git:

```bash
# pull project from github 
git clone https://github.com/kiurd-gentleman/coder71-test.git
```

Next, move into the new project’s folder and install all its dependencies:

```bash
# move into the new folder
cd coder71-test
composer install
```

then copy `.env.example` to `.env` and edit database credentials from `.env`:

```bash
# copy .env.example to .env
cp .env.example .env
```
then edit database credentials from `.env`

after that create a database with the same name you have in `.env` file


after that run the project by following command:

```bash
php -S localhost:8000 -t public
```
for run the migration run the following the link

```
http://localhost:8000/install
```

If you want to store product review in the database, you need to run the following url

```
http://localhost:8000/product-review  method POST

#parameters
product_id
user_id
rating
review
```

# API Endpoints

### Auth

| Endpoint       | Method | Body                               | Description   |
|----------------|--------|------------------------------------|---------------|
| product-review | POST   | product_id,user_id, rating, review | create review |
| user-store     | POST   | first_name, last_name, email       | create user   |

