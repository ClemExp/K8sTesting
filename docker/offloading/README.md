# Instructions to manage docker interaction with registry
# We will later deploy the container into Kubernetes via helm

# Docker build - Note: our cluster nodes are AMD64 so need to specify this during the build process
docker build --platform=linux/amd64 -t subjects-off .

# tag the container for upload into google container registry
docker tag subjects-off gcr.io/tls-terraform/subjects-off:latest

# Docker push to GCR
docker push gcr.io/tls-terraform/subjects-off:latest

# Later deploy via helm..


*********** To test dockers locally *******
docker container run -d docker_image_id
docker exec -it containerid /bin/bash
docker container rm -f containerid

