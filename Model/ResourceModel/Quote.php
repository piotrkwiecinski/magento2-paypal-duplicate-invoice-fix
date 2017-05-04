<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace PiotrKwiecinski\Quote\Model\ResourceModel;

use Magento\Quote\Model\ResourceModel\Quote as BaseQuote;

/**
 * Quote resource model
 */
class Quote extends BaseQuote
{
    /**
     * Check is order increment id use in sales/order table
     *
     * @param int $orderIncrementId
     * @return bool
     */
    public function isOrderIncrementIdUsed($orderIncrementId)
    {
        /** @var  \Magento\Framework\DB\Adapter\AdapterInterface $adapter */
        $adapter = $this->getConnection();
        $bind = [':increment_id' => $orderIncrementId];
        /** @var \Magento\Framework\DB\Select $select */
        $select = $adapter->select();
        $select->from($this->getTable('sales_order'), 'entity_id')->where('increment_id = :increment_id');
        $entity_id = $adapter->fetchOne($select, $bind);
        if ($entity_id > 0) {
            return true;
        }
        return false;
    }
}
