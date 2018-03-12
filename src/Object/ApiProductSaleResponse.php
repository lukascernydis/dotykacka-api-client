<?php

namespace DotykackaPHPApiClient\Object;

use DotykackaPHPApiClient\ObjectBase;

class ApiProductSaleResponse extends ObjectBase
{
    /** @var int */
    public $readyState;

    /** @var string */
    public $responseText;

    /** @var int */
    public $status;

    /** @var string */
    public $statusText;
}
