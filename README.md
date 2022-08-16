
#Shop
shop project with laravel 

This project runs with Laravel version 8.

##Getting started

install on your machine:PHP (>= 7.0.0), Laravel, Composer and Node.js.

# install dependencies

composer install

npm install

# create .env file and generate the application key
copy .env.example .env

Open your .env file 
and change: the database name **(onlineShop)**

**and change:**
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=fe6d9bc2c40f3b
MAIL_PASSWORD=5ed9b17b9bfc4f
MAIL_FROM_ADDRESS=mahtiteymoori@yahoo.com


**And add these codes to the end of the .env file**

GOOGLE_CLIENT_ID=956302686459-jqt32fhh0rskrv3b42oqm6dbceeqrr2c.apps.googleusercontent.com
GOOGLE_SECRET_KEY=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
GOOGLE_CALLBACK_URL=http://localhost:8000/auth/google/callback


GOOGLE_RECAPTCHA_SITE_KEY=6Le7-rIfAAAAAA30wRPP7ilfMSgHM3Xh9_V9EI17
GOOGLE_RECAPTCHA_SECRET_KEY=6Le7-rIfAAAAAM7lxtql1mb9EBSNn0nKSDvUmDU1


php artisan key:generate

# build CSS and JS assets
npm run dev

npm run prod

php artisan migrate  

php artisan serve

 Access it at (http://localhost:8000)
