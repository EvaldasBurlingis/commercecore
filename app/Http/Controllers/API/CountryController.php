<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CountryStateResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    public function getCountries(): AnonymousResourceCollection
    {
        // Pretend to get countries from a database/package
        $countries = [
            ['name' => 'Country 1', 'code' => 'C1'],
            ['name' => 'Country 2', 'code' => 'C2'],
            ['name' => 'Country 3', 'code' => 'C3'],
            ['name' => 'Country 4', 'code' => 'C4'],
            ['name' => 'Country 5', 'code' => 'C5'],
        ];

        return CountryResource::collection($countries);
    }

    public function getStates(string $country): AnonymousResourceCollection
    {
        // Pretend to get states from a database/package
        $states = [
            ['name' => 'State 1-1', 'code' => 'S1-1', 'country_code' => 'C1', 'country_name' => 'Country 1'],
            ['name' => 'State 1-2', 'code' => 'S1-2', 'country_code' => 'C1', 'country_name' => 'Country 1'],
            ['name' => 'State 1-3', 'code' => 'S1-3', 'country_code' => 'C1', 'country_name' => 'Country 1'],
            ['name' => 'State 2-1', 'code' => 'S2-1', 'country_code' => 'C2', 'country_name' => 'Country 2'],
            ['name' => 'State 2-2', 'code' => 'S2-2', 'country_code' => 'C2', 'country_name' => 'Country 2'],
            ['name' => 'State 3-1', 'code' => 'S3-1', 'country_code' => 'C3', 'country_name' => 'Country 3'],
            ['name' => 'State 3-2', 'code' => 'S3-2', 'country_code' => 'C3', 'country_name' => 'Country 3'],
            ['name' => 'State 4-1', 'code' => 'S4-1', 'country_code' => 'C4', 'country_name' => 'Country 4'],
            ['name' => 'State 4-2', 'code' => 'S4-2', 'country_code' => 'C4', 'country_name' => 'Country 4'],
            ['name' => 'State 5-1', 'code' => 'S5-1', 'country_code' => 'C5', 'country_name' => 'Country 5'],
            ['name' => 'State 5-2', 'code' => 'S5-2', 'country_code' => 'C5', 'country_name' => 'Country 5'],
        ];

        $states = array_filter($states, function ($state) use ($country) {
            return strtolower($state['country_name']) === strtolower(Str::replace('_', ' ', $country));
        });

        return CountryStateResource::collection($states);
    }
}
