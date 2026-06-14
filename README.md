# Unicorn 2 ApiWeb OTTO Minimal Sample

This repository is a standalone minimal ApiWeb connector sample. It implements
only the operational core usually needed for a small connector:

- credential validation
- capability metadata
- order download
- shipment confirmation
- stock update
- price update
- processing-time update

Public protocol documentation:

- https://webservice.marcos-software.de/index.html
- https://webservice.marcos-software.de/endpoints.html
- https://webservice.marcos-software.de/samples.html
- https://webservice.marcos-software.de/conformance.html
- https://webservice.marcos-software.de/field-test-checklist.html
- https://webservice.marcos-software.de/openapi.yaml

## Local start

```powershell
$env:APIWEB_TEST_KEY='local-dev-api-key-2026'
$env:APIWEB_OTTO_MODE='demo'
php -S 127.0.0.1:18080 -t .
```

In Unicorn 2 configure:

```text
http://127.0.0.1:18080/api.php
```

## Real OTTO mode

```powershell
$env:APIWEB_OTTO_MODE='real'
$env:OTTO_ENVIRONMENT='live'
$env:OTTO_AUTH_MODE='bearer'
$env:OTTO_ACCESS_TOKEN='your-token'
php -S 127.0.0.1:18080 -t .
```

No OTTO secret is hardcoded. Use environment variables or protected hosting
settings for all credentials.

## Negative tests

Set `APIWEB_FAILURE_MODE` to `invalid_credentials`, `getOrders:quota`,
`getOrders:api_down` or `getOrders:unknown` to verify the unhappy paths.

## Field-tested pitfalls

- ApiWeb body hashes and HMAC signatures are Base64 encoded, not hex encoded.
- Response signatures use transport marker `RESPONSE`.
- Response `X-Unicorn-Api-Method` must be the original ApiWeb method, never
  `response`.
- Sign the exact raw JSON body that is sent over HTTP.
- After FTP upload, verify the exact public URL to `api.php`; some hostings use
  a subfolder.
- Unsigned public calls to `api.php` should return a JSON `401`; `404` means
  wrong path and `500` means PHP/server failure.
- Protect `config.php`, `.env`, backups and logs from public download.
- For stock, price and processing-time updates, resolve the marketplace
  offer/listing/unit id from `ShopId`, SKU or EAN when the marketplace does not
  use the same identifier.
