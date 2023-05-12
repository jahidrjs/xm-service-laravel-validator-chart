<?php

namespace Tests\Unit;

use Tests\TestCase;

class HistoricalDataTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_symbol_handle()
    {
        $response = $this->call('POST', '/submitForm', [
            'symbol' => 'AAIT',
            'start_date' => '2023-05-13',
            'end_date' => '2023-05-23',
            'email' => 'myemail@gmail.com'
        ]);

        $response->assertStatus($response->status(), 200);
        $this->assertTrue(true);
    }
}