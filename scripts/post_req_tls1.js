import http from 'k6/http';
import { sleep, check } from 'k6';
import { randomString } from 'https://jslib.k6.io/k6-utils/1.2.0/index.js';

export const options = {
  // following TLS1.3 3 cipher suites are supported by server certificates
  tlsCipherSuites: ['TLS_AES_256_GCM_SHA384', 'TLS_AES_128_GCM_SHA256', 'TLS_CHACHA20_POLY1305_SHA256'],
  // 1.2 ciphers with k6 - 
  //     TLS_ECDHE_ECDSA_WITH_AES_128_GCM_SHA256:TLS_ECDHE_ECDSA_WITH_AES_256_GCM_SHA384:TLS_ECDHE_ECDSA_WITH_CHACHA20_POLY1305
  //tlsVersion: http.TLS_1_2,
  //tlsCipherSuites: ['TLS_ECDHE_ECDSA_WITH_CHACHA20_POLY1305'],
};

export default function () {
  const url = 'https://tlsoff.clemoregan.com/'; // Replace with the actual URL of the PHP application
  const randomFirstName = randomString(8);
  const randomLastName = randomString(8);
  const payload = {
    name: `${randomFirstName} ${randomLastName}`,
    email: `${randomFirstName}_${randomLastName}@uc3m.es`,
    subject: randomString(1, '1234'),
    motivational_letter: randomString(4000),
  };

  const headers = {
    'Content-Type': 'application/x-www-form-urlencoded',
  };

  const data = Object.keys(payload)
    .map((key) => `${encodeURIComponent(key)}=${encodeURIComponent(payload[key])}`)
    .join('&');

  const response = http.post(url, data, { headers });

  //console.log(`Response status: ${response.status}`);
  //console.log(`Response body: ${response.body}`);

  check (response, {
    'is status code 200': (r) => r.status === 200,
    'is TLSv1.2': (r) => r.tls_version === http.TLS_1_2,
    'is sha256 cipher suite': (r) => r.tls_cipher_suite === 'TLS_AES_128_GCM_SHA256',
  });

  sleep(1); // Optional sleep to simulate user behavior (1 second in this case)
}
