<?php

namespace Ar\Calculation\Helper;

class Price extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_price;

    public function getPrice($product){

        $this->_price = $product->getFinalPrice();

        $this->_price = $this->_price * 10;
        return $this->_price;
    }
}