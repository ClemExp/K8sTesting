# K8sTesting
Test harness &amp; scripts to test sample containerised applications

## GET request tests

With GET requests, we tend to use --iterations over --duration, in order to measure the performance over a number of requests, for example:
```
k6 run --vus 10 --iterations 100 scripts/get_req_tls1.js
```

## POST request tests
With POST requests we tend to use more --duration parameter, for example:

```
k6 run --vus 10 --duration 30s scripts/post_req_tls1.js
```
