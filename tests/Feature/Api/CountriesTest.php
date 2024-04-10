<?php

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

test('can access countries and country states endpoints', function () {
    $response = $this->get('/api/countries');

    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'name',
                'code',
            ],
        ],
    ]);

    $country = $response->json('data')[0];
    $formattedCountry = strtolower(Str::replace(' ', '_', $country['name']));

    $response = $this->get("/api/countries/{$country['name']}/states");

    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'name',
                'code',
                'country_code',
                'country_name',
            ],
        ],
    ]);
})->group('api');

