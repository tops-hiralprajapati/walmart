# Walmart\Models\MP\MX\Returns\ReturnOrder

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**returnOrderId** | **string** | Return order identifier of the return order. This is the same as RMA number. | [optional]
**customerEmail** | **string** | Customer email address | [optional]
**customerName** | [**\Walmart\Models\MP\MX\Returns\CustomerName**](CustomerName.md) |  | [optional]
**customerOrderId** | **string** | A unique ID associated with the sales order for specified customer | [optional]
**returnOrderDate** | **string** | Date for return order date | [optional]
**returnOrderLines** | [**\Walmart\Models\MP\MX\Returns\ReturnOrderLine[]**](ReturnOrderLine.md) | A list of order lines in the return order | [optional]
**returnOrderShipments** | [**\Walmart\Models\MP\MX\Returns\Shipment[]**](Shipment.md) | The shipments for return orders | [optional]


[[Back to Model list]](./) [[Back to API list]](../../../../../README.md#supported-apis) [[Back to README]](../../../../../README.md)
