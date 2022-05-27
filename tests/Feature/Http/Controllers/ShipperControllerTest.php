<?php

namespace Tests\Feature\Http\Controllers;


class ShipperControllerTest extends AbstractApiTestCase
{
    public function testShipperIndex()
    {
        $response = $this->getRequest('/shippers');
        $response->assertStatus(200);
    }

    public function testShipperStore()
    {
        $response = $this->postRequest(
            '/shippers',
            [
                'company_name' => 'company name test',
                'address' => 'address test',
                'primary_contact_id' => 1
            ]
        );

        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'The given data was invalid.'
        ]);

        $response = $this->postRequest(
            '/shippers',
            [
                'address' => 'address test'
            ]
        );

        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'The given data was invalid.'
        ]);

        $response = $this->postRequest(
            '/shippers',
            [
                'primary_contact_id' => 1
            ]
        );

        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'The given data was invalid.'
        ]);

        $response = $this->postRequest(
            '/shippers',
            [
                'contact_ids' => [2, 3]
            ]
        );

        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => 'The given data was invalid.'
        ]);

        $response = $this->postRequest(
            '/shippers',
            [
                'company_name' => 'company name test',
                'address' => 'address test',
                'primary_contact_id' => 1,
                'contact_ids' => [2, 3]
            ]
        );

        $response->assertStatus(201);
    }

    public function testShipperUpdate()
    {
        $response = $this->postRequest(
            '/shippers/1',
            [
                'company_name' => 'company name test',
                'address' => 'address test',
                'primary_contact_id' => 1
            ]
        );

        $response->assertStatus(405);
    }
}
