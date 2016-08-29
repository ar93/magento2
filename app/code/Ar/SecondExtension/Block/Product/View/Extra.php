<?php

namespace Ar\SecondExtension\Block\Product\View;
use Magento\Catalog\Block\Product\AbstractProduct;

class Extra extends AbstractProduct
{
    public function getSomething() {
        return 'something';
    }
}