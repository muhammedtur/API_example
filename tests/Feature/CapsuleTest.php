<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CapsuleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_json_response()
    {
        $response = $this->json('GET', '/api/capsules', ['status' => 'active|retired|unknown|destroyed']);
        $response
        ->assertJson(fn (AssertableJson $json) =>
            $json
            ->has('0.capsule_serial')
            ->hasAny(
                '0.capsule_id',
                '0.status',
                '0.original_launch',
                '0.original_launch_unix',
                '0.missions',
                '0.landings',
                '0.type',
                '0.details',
                '0.capsreuse_countule_serial'
            )
        );
    }
}
