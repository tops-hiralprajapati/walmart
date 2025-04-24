# Walmart\Models\MP\US\Fulfillment\InboundShipmentErrorsResponseWrapper

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**inboundOrderId** | **string** | Unique ID identifying inbound shipment requests | [optional]
**createdDate** | **\DateTime** | created date for the request | [optional]
**returnAddress** | [**\Walmart\Models\MP\US\Fulfillment\ReturnAddress**](ReturnAddress.md) |  | [optional]
**orderItems** | [**\Walmart\Models\MP\US\Fulfillment\OrderItem[]**](OrderItem.md) | inbound shipment request line items | [optional]
**errors** | [**\Walmart\Models\MP\US\Fulfillment\Error[]**](Error.md) | Error in inbound shipment creation | [optional]


[[Back to Model list]](./) [[Back to API list]](../../../../../README.md#supported-apis) [[Back to README]](../../../../../README.md)
