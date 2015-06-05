<?php

/**
 * Class HomeTest
 *
 * @author Claudio Ludovico Panetta (@ludo237)
 */
final class HomeTest extends TestCase
{
    /** @test */
    final public function testBasicExample()
    {
        $response = $this->call('GET', '/');
        $this->assertResponseOk();
    }
}
