# Instructions to manage docker interaction with registry
# We will later deploy the container into Kubernetes via helm

# Docker build - Note: our cluster nodes are AMD64 so need to specify this during the build process
docker build --platform=linux/amd64 -t subjects-on .

# tag the container for upload into google container registry
docker tag subjects-on gcr.io/tls-terraform/subjects-on:latest

# Docker push to GCR
docker push gcr.io/tls-terraform/subjects-on:latest

# Later deploy via helm..

