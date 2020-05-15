<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FactoryTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;


    public function testBasicTest()
    {
        $biblioteca = factory(Biblioteca::class)->make();

        $this->assertNotEmpty($biblioteca->descricao);
    }
}
