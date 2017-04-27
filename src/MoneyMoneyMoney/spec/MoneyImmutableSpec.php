<?php

namespace spec\VictoriaPlum\MoneyMoneyMoney;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoneyImmutableSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(12.87);
    }

    function it_has_a_price_in_pence_without_tax()
    {
        $this->getPenceWithoutTax()->shouldReturn(1287);
    }

    function it_has_a_price_in_pounds_without_tax()
    {
        $this->getPoundsWithoutTax()->shouldReturn(12.87);
    }

    function it_has_a_price_in_pence_with_tax()
    {
        $this->getPenceWithTax()->shouldReturn(1544);
    }

    function it_has_a_price_in_pounds_with_tax()
    {
        $this->getPoundsWithTax()->shouldReturn(15.44);
    }

    function it_can_have_an_additional_price_added_without_tax()
    {
        $this->withPriceAddition(3.67)->getPoundsWithoutTax()->shouldReturn(16.54);
    }

    function it_can_calculate_the_tax_amount_using_the_given_tax_rate()
    {
        $this->withPriceAddition(3.67)->withTaxAdjustment(0.34)->getTaxAmountInPounds()->shouldReturn(5.62);
    }
}
