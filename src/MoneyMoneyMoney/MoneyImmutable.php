<?php

namespace VictoriaPlum\MoneyMoneyMoney;

final class MoneyImmutable
{
    const STANDARD_TAX_RATE = 0.2;

    private $tax_rate;

    private $price_without_tax;

    /**
     * Create a new MoneyImmutable class
     *
     * @param float $price_without_tax  The price without tax in pounds
     * @param float $price_addition Prrice addition be included without tax
     * @param float $tax_rate Tax rate adjustment be used
     * return void
     */
    public function __construct($price_without_tax, $tax_rate = null)
    {
        $this->price_without_tax = $price_without_tax;
        $this->tax_rate = $tax_rate ?? self::STANDARD_TAX_RATE;
    }

    /**
     * Get the price of product in pence without tax
     * @return integer Number of pence
     */
    public function getPenceWithoutTax()
    {
        return (int) round($this->getPoundsWithoutTax() * 100, 0, PHP_ROUND_HALF_UP);
    }

    /**
     * Get the price of the product in pounds without tax
     * @return float Number of pounds
     */
    public function getPoundsWithoutTax()
    {
        return $this->price_without_tax;
    }

    /**
     * Get the price of the product in pence including tax
     * @return integer The number of pence
     */
    public function getPenceWithTax()
    {
        return (int) round($this->getPoundsWithTax() * 100, 0, PHP_ROUND_HALF_UP);
    }

    /**
     * Get the price of the product in pounds including tax
     * @return float Number of pounds
     */
    public function getPoundsWithTax()
    {
        return round($this->getPoundsWithoutTax() + $this->getTaxAmountInPounds(), 2);
    }

    /**
     * Get the amount of tax in pounds
     * @return float Number of pounds
     */
    public function getTaxAmountInPounds()
    {
        return round($this->getPoundsWithoutTax() * $this->tax_rate, 2);
    }

    /**
     * Add price addition to price without tax
     * @param  float  $value The amount to add to price
     * @return object New MoneyImmutable object with adjusted price
     */
    public function withPriceAddition($value)
    {
        $price_without_tax = $this->price_without_tax;
        $new_price_without_tax = $price_without_tax + $value;

        return new MoneyImmutable($new_price_without_tax);
    }

    /**
     * Alter the tax rate used
     * @param  float  $value The new tax rate
     * @return object New MoneyImmutable object with adjusted tax rate
     */
    public function withTaxAdjustment($value)
    {
        $new_tax_rate = $value;

        return new MoneyImmutable($this->price_without_tax, $new_tax_rate);
    }


}
