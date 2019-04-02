<?php

declare(strict_types=1);

namespace Nagoyaphp\Dokaku15;

use PHPUnit\Framework\TestCase;

class Dokaku15Test extends TestCase
{
    /**
     * @var Dokaku15
     */
    protected $dokaku15;

    protected function setUp() : void
    {
        $this->dokaku15 = new Dokaku15;
    }

    public function testIsInstanceOfDokaku15() : void
    {
        $actual = $this->dokaku15;
        $this->assertInstanceOf(Dokaku15::class, $actual);
    }
}
