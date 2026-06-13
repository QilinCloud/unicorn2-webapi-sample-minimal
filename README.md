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
