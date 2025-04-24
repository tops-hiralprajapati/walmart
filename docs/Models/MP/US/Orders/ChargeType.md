# Walmart\Models\MP\US\Orders\ChargeType

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**chargeType** | **string** | The charge type for line items can be one of the following: PRODUCT or SHIPPING For details, refer to 'Charge Types' |
**chargeName** | **string** | If chargeType is PRODUCT, chargeName is ItemPrice. If chargeType is PRODUCT and includes a chargeName as SubscriptionDiscount, these are subscription orders with a discount. If chargeType is SHIPPING, chargeName is Shipping |
**chargeAmount** | [**\Walmart\Models\MP\US\Orders\MoneyTypeV2**](MoneyTypeV2.md) |  |
**tax** | [**\Walmart\Models\MP\US\Orders\TaxType**](TaxType.md) |  | [optional]


[[Back to Model list]](./) [[Back to API list]](../../../../../README.md#supported-apis) [[Back to README]](../../../../../README.md)
