<?php

namespace VictoriaPlum\MoneyMoneyMoney;

use VictoriaPlum\MoneyMoneyMoney\MoneyImmutable;

class BulkMoneyParser
{

    protected $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function process()
    {
        $products = array();

        foreach($this->products as $k=>$product) {
            // create new money class using product price
            $price = new MoneyImmutable($product['price_without_tax']);
            $adjustedPrice = $price
                ->withPriceAddition($product['price_addition_without_tax'])
                ->withTaxAdjustment($product['tax_rate_adjustment']);

            $products[$k]['item_code'] = $product['item_code'];
            $products[$k]['pence_with_tax'] = $adjustedPrice->getPenceWithTax();
            $products[$k]['pence_without_tax'] = $adjustedPrice->getPenceWithoutTax();
            $products[$k]['pounds_with_tax'] = $adjustedPrice->getPoundsWithTax();
            $products[$k]['pounds_without_tax'] = $adjustedPrice->getPoundsWithoutTax();
        }

        return $products;
    }


}


