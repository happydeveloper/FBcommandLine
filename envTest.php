<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require 'classes/env.php';

class envTest extends TestCase
{
    public $env;

    protected function setUp(): void
    {
        $this->env = new env();
    }

    public function testReadEnv()
    {
        $result = $this->env->readEnv();
        $this->assertEquals("1", $result);
    }


}
