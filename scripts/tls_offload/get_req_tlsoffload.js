import http from 'k6/http';
import { sleep, check } from 'k6';

export const options = {
  // 1.3 cipher suites: 
  //     TLS_AES_256_GCM_SHA384:TLS_AES_128_GCM_SHA256:TLS_CHACHA20_POLY1305_SHA256 
  //tlsCipherSuites: ['TLS_AES_256_GCM_SHA384', 'TLS_AES_128_GCM_SHA256', 'TLS_CHACHA20_POLY1305_SHA256'],
  //tlsCipherSuites: ['TLS_AES_256_GCM_SHA384'],
  // 1.2 Ciphers Offload cluster
  //     TLS_ECDHE_RSA_WITH_AES_128_GCM_SHA256:TLS_ECDHE_RSA_WITH_AES_256_GCM_SHA384:TLS_ECDHE_RSA_WITH_CHACHA20_POLY1305
  //tlsVersion: http.TLS_1_2,
  tlsCipherSuites: ['TLS_ECDHE_RSA_WITH_CHACHA20_POLY1305'],
};

export default function () {
  var domain = 'https://tlsoff.clemoregan.com/';
  let res = http.get(domain);
  //console.log(`ciper suite: "${res.tls_cipher_suite}"`)
  // Check: valid response & ciphers used
  // Note: https://k6.io/docs/using-k6/protocols/ssl-tls/ssl-tls-version-and-ciphers/
  //    Due to limitations in the underlying go implementation, changing the ciphers for TLS 1.3 is not supported and will do nothing.
  //    So still need to handle cipher change during client offer
  check (res, {
    'is status code 200': (r) => r.status === 200,
    'is TLSv1.2': (r) => r.tls_version === http.TLS_1_2,
    'is sha256 cipher suite': (r) => r.tls_cipher_suite === 'TLS_AES_128_GCM_SHA256',
  });
  sleep(1);
}
