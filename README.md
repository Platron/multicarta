Platron Multicarta SDK
===============
## Install
<pre><code>composer require payprocessing/multicarta-sdk</pre></code>

## Tests
To use unit tests
```
vendor/bin/phpunit tests/unit
```

To use integration tests copy tests/integration/ConfigSample.php and delete Sample substring. 
Define constants in Config class:
```php
const URL = 'multicarta url';
const CERTIFICATE_PATH = 'absolute path to certificate';
const PRIVATE_KEY_PATH = 'absolute path to private key';
const MERCHANT = 'your merchant id';
const TDS_VENDOR_MER_ID = 'vendor merchant id';
const TDS_VENDOR_NAME = 'vendor merchant name';
const PAN = 'test card pan';
const EXP_DATE = 'test card date';
```

Than use
```
vendor/bin/phpunit tests/integration
```

## Example

```php

$url = '';
$certificatePath = '';
$privateKeyPath = '';
$Merchant = '';
$Amount = '';
$Description = '';
$TDSVendorMerID = '';
$TDSVendorName = '';

$builder = Platron\multicarta\mpi\CreateOrderRequestBuilder(
	$Merchant,
	$Amount,
	$Description,
	$TDSVendorMerID,
	$TDSVendorName
);
$request = $builder->getRequest();
$client = new Platron\multicarta\mpi\Client($certificatePath, $privateKeyPath);
$response = $client->sendRequest($url, $request);
$parser = new Platron\multicarta\mpi\CreateOrderResponseParser($response);

echo $parser->isValid();
echo $parser->isSuccess();
echo $parser->getOrderID();
echo $parser->getSessionID();
```