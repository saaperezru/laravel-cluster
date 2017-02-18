docker build -f app.docker -t app:1.0 .
docker run --rm -it --name app-container -p 8080:8080 -v ./:/workspace app:1.0 /bin/bash
