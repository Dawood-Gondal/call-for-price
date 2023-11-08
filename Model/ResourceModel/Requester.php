<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_CallForPrice
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\CallForPrice\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Requester extends AbstractDb
{
    /**
     * @param Context $context
     * @param $resourcePrefix
     */
    public function __construct(
        Context $context,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('m2c_call_for_price', 'id');
    }
}
