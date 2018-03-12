<?php

namespace DotykackaPHPApiClient\Service;

use DotykackaPHPApiClient\Object\ApiProductSaleRequest;
use DotykackaPHPApiClient\Object\ApiProductSaleResponse;
use DotykackaPHPApiClient\Object\Supplier;
use DotykackaPHPApiClient\Object\Warehouse;
use DotykackaPHPApiClient\Response\Error;
use DotykackaPHPApiClient\ServiceBase;

class StockService extends ServiceBase
{
    /**
     * @param int $cloudId
     *
     * @return Warehouse[]|Error
     */
    public function getWarehouseList($cloudId)
    {
        $response = $this->apiClient->sendRequest(
                'GET',
                'api/stock/'.$cloudId.'/list'
        );

        if (isset($response['error'])) {
            return new Error($response['error']);
        }

        $list = array();

        foreach ($response as $item) {
            $responseObject = new Warehouse($item);
            $list[] = $responseObject;
        }

        return $list;
    }

    /**
     * Create sale stocklog and update stockstatus of the product
     *
     * @param ApiProductSaleRequest $apiProductSaleRequest
     * @return ApiProductSaleResponse|Error
     */
    public function createProductSale(ApiProductSaleRequest $apiProductSaleRequest)
    {
        $response = $this->apiClient->sendRequest(
                'POST',
                'api/product/sale',
                array(),
                $apiProductSaleRequest
        );

        if (isset($response['error'])) {
            return new Error($response['error']);
        }

        return new ApiProductSaleResponse($response);
    }

    /**
     * @param string $file
     *
     * @return Error|mixed|null
     */
    public function uploadDeliveryNote($file)
    {
        $response = $this->apiClient->sendRequest(
                'POST',
                'api/stock/delivery-note/upload',
                array(),
                null,
                array(
                        'file' => array(
                                'name' => 'file',
                                'path' => $file,
                                'mime' => 'text/xml',
                        ),
                )
        );

        if (isset($response['error'])) {
            return new Error($response['error']);
        }

        return $response;
    }
}
