# K8sTesting
Test harness &amp; scripts to test sample containerised applications

## GET request tests

With GET requests, we tend to use --iterations over --duration, in order to measure the performance over a number of requests, for example:
```
k6 run --vus 10 --iterations 100 scripts/tls_offload/get_req_tlsoffload.js
k6 run --vus 10 --iterations 100 scripts/tls_e2e/get_req_tlse2e.js
```

## POST request tests
With POST requests we tend to use more --duration parameter, for example:

```
k6 run --vus 10 --duration 60s scripts/tls_offload/post_req_tlsoffload.js
k6 run --vus 10 --duration 60s scripts/tls_e2e/post_req_tlse2e.js
```
