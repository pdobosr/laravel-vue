<?php

namespace Tests\Feature\Http\Controllers;


class ContactControllerTest extends AbstractApiTestCase
{
    public function testContactIndex()
    {
        $response = $this->getRequest('/contacts');
        $response->assertStatus(200);
    }

    public function testContactStore()
    {
        $response = $this->postRequest(
            '/contacts',
            [
                'name' => 'test_name'
            ]
        );

        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'The given data was invalid.'
        ]);

        $response = $this->postRequest(
            '/contacts',
            [
                'number' => '123456789'
            ]
        );

        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'The given data was invalid.'
        ]);

        $response = $this->postRequest(
            '/contacts',
            [
                'name' => 'contact name test',
                'number' => '123456789'
            ]
        );

        $response->assertStatus(201);
    }
}
