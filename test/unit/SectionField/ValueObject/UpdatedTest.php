<?php
declare (strict_types=1);

namespace Tardigrades\SectionField\ValueObject;

use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass Tardigrades\SectionField\ValueObject\Updated
 * @covers ::<private>
 * @covers ::__construct
 */
class UpdatedTest extends TestCase
{
    /**
     * @test
     * @covers ::fromDateTime
     * @covers ::getDateTime
     */
    public function it_should_create_from_DateTime()
    {
        $datetime = new \DateTime('2000-11-11T12:12:12');
        $updated = Updated::fromDateTime($datetime);
        $this->assertInstanceOf(Updated::class, $updated);
        $this->assertEquals($updated->getDateTime(), new \DateTime('2000-11-11T12:12:12'));
        $this->assertEquals((string)$updated, '2000-11-11T12:12');
    }
}
