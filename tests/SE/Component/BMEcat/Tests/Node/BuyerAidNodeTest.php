<?php

namespace SE\Component\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;
use SE\Component\BMEcat\Node\BuyerPidNode;

/**
 * @package SE\Component\BMEcat\Tests
 * @author Jochen Pfaeffle <jochen.pfaeffle.dev@gmail.com>
 */
class BuyerAidNodeTest extends TestCase
{
    public function setUp() : void
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    /**
     * @test
     */
    public function Serialize_With_Null_Values()
    {
        $node = new BuyerPidNode();
        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_buyer_pid_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function Serialize_Without_Null_Values()
    {
        $node = new BuyerPidNode();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_buyer_pid_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }
}
