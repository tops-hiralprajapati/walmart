# Walmart\Apis\MP\MX\FeedsApi  
All URIs are relative to https://marketplace.walmartapis.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getAllFeedStatuses()**](#getAllFeedStatuses) | **GET** /v3/feeds | All feed statuses |
| [**getFeedItemStatus()**](#getFeedItemStatus) | **GET** /v3/feeds/{feedId} | Feed item status |


## `getAllFeedStatuses()`

```php
getAllFeedStatuses($feedId, $offset, $limit): \Walmart\Models\MP\MX\Feeds\FeedRecordResponse
```
All feed statuses

Returns the feed statuses for all the specified Feed IDs.

### Example

```php
<?php
use Walmart\Configuration;
use Walmart\Enums\Country;
use Walmart\Walmart;

require_once __DIR__ . '/vendor/autoload.php';

$config = new Walmart\Configuration([
    'clientId' => 'CLIENT_ID',          // May not be necessary for all endpoints, particularly outside the US
    'clientSecret' => 'CLIENT_SECRET',  // Ditto above
    'country' => Country::MX,           // Default Country::US if not set
]);

$api = Walmart::marketplace($config)->feeds();

$feedId = 'feedId_example'; // string | A unique ID returned from the Bulk Upload API, used for tracking the Feed File. Special characters must be escaped. (e.g., feedId: '...3456@789...' must be entered in the URL as '...3456%40789).
$offset = '0'; // string | The object response to start with, where 0 is the first entity that can be requested. It can only be used when includeDetails is set to true.
$limit = '50'; // string | The number of entities to be returned. It cannot be more than 50 entities. Use it only when the includeDetails is set to true.

try {
    $result = $api->getAllFeedStatuses($feedId, $offset, $limit);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling FeedsApi->getAllFeedStatuses: {$e->getMessage()}\n";
}
```

### Parameters
| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **feedId** | **string**| A unique ID returned from the Bulk Upload API, used for tracking the Feed File. Special characters must be escaped. (e.g., feedId: '...3456@789...' must be entered in the URL as '...3456%40789). | [optional] |
| **offset** | **string**| The object response to start with, where 0 is the first entity that can be requested. It can only be used when includeDetails is set to true. | [optional] [default to '0'] |
| **limit** | **string**| The number of entities to be returned. It cannot be more than 50 entities. Use it only when the includeDetails is set to true. | [optional] [default to '50'] |


### Return type

[**\Walmart\Models\MP\MX\Feeds\FeedRecordResponse**](../../../Models/MP/MX/Feeds/FeedRecordResponse.md)

### Authorization

This endpoint requires the following authorization methods:

* `basic`: Basic authentication with a Walmart Client ID and Client Secret
* `accessToken`: Header authentication with a Walmart access token, which is automatically generated using your Client ID and Client Secret. The token is valid for 15 minutes, and will be passed in the WM_SEC.ACCESS_TOKEN header

See the [Authorization](../../../../README.md#authorization) section of the README for more information.


[[Back to top]](#) [[Back to API list]](../../../../README.md#supported-apis)
[[Back to Model list]](../../../Models/MP/MX)
[[Back to README]](../../../../README.md)

## `getFeedItemStatus()`

```php
getFeedItemStatus($feedId, $includeDetails, $offset, $limit): \Walmart\Models\MP\MX\Feeds\PartnerFeedResponse
```
Feed item status

Returns the feed and item status for a specified Feed ID.

### Example

```php
<?php
use Walmart\Configuration;
use Walmart\Enums\Country;
use Walmart\Walmart;

require_once __DIR__ . '/vendor/autoload.php';

$config = new Walmart\Configuration([
    'clientId' => 'CLIENT_ID',          // May not be necessary for all endpoints, particularly outside the US
    'clientSecret' => 'CLIENT_SECRET',  // Ditto above
    'country' => Country::MX,           // Default Country::US if not set
]);

$api = Walmart::marketplace($config)->feeds();

$feedId = 'feedId_example'; // string | The feed ID.
$includeDetails = 'false'; // string | Includes details of each entity in the feed. Do not set this parameter to true.
$offset = '0'; // string | The object response to start with, where 0 is the first entity that can be requested. It can only be used when includeDetails is set to true.
$limit = '50'; // string | The number of entities to be returned. It cannot be more than 50 entities. Use it only when the includeDetails is set to true.

try {
    $result = $api->getFeedItemStatus($feedId, $includeDetails, $offset, $limit);
    print_r($result);
} catch (Exception $e) {
    echo "Exception when calling FeedsApi->getFeedItemStatus: {$e->getMessage()}\n";
}
```

### Parameters
| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **feedId** | **string**| The feed ID. | |
| **includeDetails** | **string**| Includes details of each entity in the feed. Do not set this parameter to true. | [optional] [default to 'false'] |
| **offset** | **string**| The object response to start with, where 0 is the first entity that can be requested. It can only be used when includeDetails is set to true. | [optional] [default to '0'] |
| **limit** | **string**| The number of entities to be returned. It cannot be more than 50 entities. Use it only when the includeDetails is set to true. | [optional] [default to '50'] |


### Return type

[**\Walmart\Models\MP\MX\Feeds\PartnerFeedResponse**](../../../Models/MP/MX/Feeds/PartnerFeedResponse.md)

### Authorization

This endpoint requires the following authorization methods:

* `basic`: Basic authentication with a Walmart Client ID and Client Secret
* `accessToken`: Header authentication with a Walmart access token, which is automatically generated using your Client ID and Client Secret. The token is valid for 15 minutes, and will be passed in the WM_SEC.ACCESS_TOKEN header

See the [Authorization](../../../../README.md#authorization) section of the README for more information.


[[Back to top]](#) [[Back to API list]](../../../../README.md#supported-apis)
[[Back to Model list]](../../../Models/MP/MX)
[[Back to README]](../../../../README.md)
