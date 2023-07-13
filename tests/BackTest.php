<?php

namespace App\Tests\Entity;

use App\Entity\Back;
use PHPUnit\Framework\TestCase;

class BackTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $back = new Back();

        $back->setNombre('Symfony');
        $back->setLogo('296002a8d6c92fb7fd0f9a02e616ba30.png');
        $back->setNivel('Pro');

        $this->assertEquals('Symfony', $back->getNombre());
        $this->assertEquals('296002a8d6c92fb7fd0f9a02e616ba30.png', $back->getLogo());
        $this->assertEquals('Pro', $back->getNivel());
    }
}
