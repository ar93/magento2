<?php

namespace Ar\Calculation\Test\Unit\Observer;
use Ar\Calculation\Observer\Calculation;

class CalculationTest extends \PHPUnit_Framework_TestCase
{
    protected $observer;

    public function setUp()
    {

        $this->priceHelper = $this->getMockBuilder('Ar\Calculation\Helper\Price')
            ->disableOriginalConstructor()
            ->getMock();

        $this->context = $this->getMockBuilder('\Magento\Framework\App\Action\Context')
            ->disableOriginalConstructor()
            ->getMock();


        $this->observer = new Calculation( $this->priceHelper, $this->context  );

        $this->observerMock = $this->getMock('\Magento\Framework\Event\Observer', [], [], '', false);
    }

    public function testCalculation()
    {
//        $this->priceHelper->expects($this->once())
//            ->method('getPrice')
//            ->will($this->returnValue(150));

        $observerReturnValue = $this->observer->execute($this->observerMock);
        $this->assertEquals($observerReturnValue, true);
    }
}