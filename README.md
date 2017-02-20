# Contacts distribution/clustering
This is a sample Laravel 5.4 application made for clustering zipcodes into two groups, based on their distance to a couple of specified zipcodes.
# Deployment 
To deploy the application install docker in your machine and then run:
```
$ docker build -f app.docker -t app:1.0 .
$ docker run --rm -it --name app-container -p 8000:8000 -v $(pwd):/workspace app:1.0 /bin/bash
# su php
$ php artisan serve --host="0.0.0.0"                                                                   
```
Then go to http://127.0.0.1:8000 inside your browser.
