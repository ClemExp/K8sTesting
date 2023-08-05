import http from 'k6/http';
import { sleep, check } from 'k6';

export default function () {
  var domain = 'https://tlsoff.clemoregan.com/';
  let res = http.get(domain);
  check (res, {
    'is status code 200': (r) => r.status === 200,
  });
  sleep(1);
}
