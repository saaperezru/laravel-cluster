# Contacts distribution/clustering
This is a sample Laravel 5.4 application made for clustering zipcodes into two groups, based on their distance to a couple of specified zipcodes.
# Deployment 
To deploy the application install docker in your machine and then run:
```
$ docker build -f app.docker -t app:1.0 .
$ docker run --rm -it --name app-container -p 8000:8000 -v $(pwd):/workspace app:1.0 /bin/bash
# su php
$ composer install
$ cp .env.example .env
$ cp contacts.csv app/storage/
$ mkdir bootstrap/cache
$ php artisan config:clear
$ php artisan key:generate
$ php artisan serve --host="0.0.0.0"
```
Then go to http://127.0.0.1:8000 inside your browser.
#Configuration
You can configure two main components:
 1. The calculator of distance between zip codes (DistanceCalculator)
 2. The algorithm that distributes agents based on the distances (AgentsDistributor)
To do so implement or choose your implementation of each interface and bind it at 
```
/app/Providers/AppServiceProvider.php
```
If you decide to use Google's or ZipCodeApi's services you should add your api's keys to the .env file:
```
GOOGLE_KEY=<your key here>
ZIPCODE_KEY=<your key here>
```
