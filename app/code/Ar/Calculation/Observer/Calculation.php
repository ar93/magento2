<?php

namespace Ar\Calculation\Observer;

use Magento\Framework\Event\ObserverInterface;

class Calculation implements ObserverInterface
{
    protected $_priceHelper;
    protected $_request;
    protected $_scopeConfig;

    private static $_current_selection = 'print_selection';

    public function __construct(
            \Ar\Calculation\Helper\Price $priceHelper,
            \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->_priceHelper = $priceHelper;
        $this->_request = $context->getRequest();
        $this->_scopeConfig = $scopeConfig;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // dispatch('catalog_product_get_final_price', ['product' => $product, 'qty' => $qty]);
        $customCalculationEnabled = $this->_scopeConfig->getValue('price_section/general/price_calculation', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if ($customCalculationEnabled) {
            $product = $observer->getEvent()->getProduct();

    //        $request = $this->_request->getParams();
    //        var_dump($request);

            //works - get the id in cart of current product
            $item_options = $product->getCustomOptions();
    //        if (isset($item_options['info_buyRequest'])) {
    //            $entity = $item_options['info_buyRequest']->getItem();
    //            $item_id = $entity->getData('item_id');
    //            var_dump($item_id);
    //        }

            //diferences - magento1 - keys of product_options are the options_ids
            //diferences - magento2 - keys of product_options starts from 0
            $product_options = $product->getOptions();
    //        var_dump($product_options);
            if (is_array($item_options))
            {
                if (!isset($request['print_options'])) {
                    foreach ($item_options as $opt) {
                        $code = str_replace('option_', '', $opt->getData('code'));
                        var_dump($opt->getData('code'));
                        var_dump($code);
                        if (is_numeric($code)) {
    //                        $prod_opt = $product_options[$code];
    //                        var_dump($prod_opt);
    //                        if ($prod_opt['sku'] == self::$_current_selection) {
    //                            $request['print_options'] = unserialize($opt->getData('value'));
    //                        }
                        }
                    }
                }
            }

            /* works - list all product options
            foreach($product->getOptions() as $o){
                $optionType = $o->getType();
                foreach($o->getValues() as $value){
                    echo "<pre>";
                    print_r($value->getData());
                    echo "</pre>";
                }
            }
            */


            // echo $product->getName();
            // echo $product->getFinalPrice();
            $newPrice = $this->_priceHelper->getPrice($product);
            $product->setPrice($newPrice);
            $product->setFinalPrice($newPrice);
        }
    }
}