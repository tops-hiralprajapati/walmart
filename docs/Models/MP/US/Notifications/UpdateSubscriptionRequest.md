# Walmart\Models\MP\US\Notifications\UpdateSubscriptionRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**eventType** | **string** | Event that is subscribed for notifications. | [optional]
**eventVersion** | **string** | Version of the specific event type | [optional]
**resourceName** | **string** | Delegated access scope that event type is mapped to. | [optional]
**eventUrl** | **string** | Destination URL where notification will be received by seller | [optional]
**authDetails** | [**\Walmart\Models\MP\US\Notifications\AuthDetails**](AuthDetails.md) |  | [optional]
**headers** | [**\Walmart\Models\MP\US\Notifications\Headers**](Headers.md) |  | [optional]
**status** | **string** | Status of the subscription. Allowed values are ACTIVE or INACTIVE | [optional]


[[Back to Model list]](./) [[Back to API list]](../../../../../README.md#supported-apis) [[Back to README]](../../../../../README.md)
