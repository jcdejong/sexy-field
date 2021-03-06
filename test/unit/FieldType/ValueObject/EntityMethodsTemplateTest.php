<?php
declare (strict_types=1);

namespace Tardigrades\FieldType\ValueObject;

use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass Tardigrades\FieldType\ValueObject\EntityMethodsTemplate
 * @covers ::<private>
 * @covers ::__construct
 */
class EntityMethodsTemplateTest extends TestCase
{
    /**
     * @test
     * @covers ::create
     * @covers ::__toString
     */
    public function it_should_create()
    {
        $template = EntityMethodsTemplate::create('wheeee');
        $this->assertInstanceOf(EntityMethodsTemplate::class, $template);
        $this->assertSame('wheeee', (string) $template);
    }
}
