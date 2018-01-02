<?php

namespace App\Controller;

use PHPUnit\Framework\TestCase;

/**
 * Class ApiControllerTest
 *
 * @package App\Controller
 */
class ApiControllerTest extends TestCase
{

    const TEST_PERSON = 'person:%s';

    const TEST_URL = 'http://kenanduman.local:8880/api/%s';

    const API_ADD  = 'add/%s';
    const API_LIST = 'list';
    const API_LAST = 'last';

    /**
     * @var
     */
    private $currentPerson;

    public function testAdd()
    {

        $this->currentPerson = sprintf(self::TEST_PERSON, mt_rand(0, 10));
        $response            = file_get_contents(sprintf(self::TEST_URL, sprintf(self::API_ADD, $this->currentPerson)));
        $result              = json_decode($response, true)[0];
        $this->assertEquals('OK', $result);
    }

    public function testList()
    {

        $response = file_get_contents(sprintf(self::TEST_URL, self::API_LIST));
        $result   = json_decode($response, true);
        $this->assertNotEmpty($result);
    }

    public function testLast()
    {

        $response = file_get_contents(sprintf(self::TEST_URL, self::API_LAST));
        $result   = json_decode($response, true);
        $this->assertNotEmpty($result[0]);
    }
}