<?php

namespace PiotrKwiecinski\Quote\Model;

use Magento\Quote\Model\Quote as BaseQuote;

class Quote extends BaseQuote
{
    /**
     * {@inheritdoc}
     */
    public function reserveOrderId()
    {
        if (!$this->getReservedOrderId()) {
            $this->setReservedOrderId($this->_getResource()->getReservedOrderId($this));
        } else {
            //checking if reserved order id was already used for some order
            //if yes reserving new one if not using old one
            if ($this->_getResource()->isOrderIncrementIdUsed($this->getReservedOrderId())) {
                $this->setReservedOrderId($this->_getResource()->getReservedOrderId($this));
            }
        }
        return $this;
    }
}