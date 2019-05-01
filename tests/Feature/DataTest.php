<?php

namespace Tests\Feature;

use App\Data;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DataTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function show_all_data()
    {
        factory(Data::class, 10)->create();

        $response = $this->json('GET', route('path.index'));

        $response->assertStatus(200);

        $response->json();

        /* Uncomment to view Response */
        //print_r($response->json());
    }

    /** @test */
    public function create_data()
    {
        $response = $this->json('POST', route('path.store'), [
            'title'       => 'Dummy title',
            'description' => 'Dummy description'
        ]);

        $response->assertStatus(200);

        $this->assertEquals('Dummy title',$response->json()['data']['title']);

        /* Uncomment to view Response */
        //print_r($response->json());
    }

    /** @test */
    public function show_specific_data()
    {
        $this->json('POST', route('path.store'), [
            'title'       => 'Dummy title',
            'description' => 'Dummy description'
        ]);

        $data = Data::all()->first();

        $response = $this->json('GET', route('path.show',$data->id));

        $response->assertStatus(200);

        $response->json();

        /* Uncomment to view Response */
        //print_r($response->json());
    }

    /** @test */
    public function update_data()
    {
        $this->json('POST', route('path.store'), [
            'title'       => 'Dummy title',
            'description' => 'Dummy description'
        ]);

        $data = Data::all()->first();

        $response = $this->json('PUT', route('path.show',$data->id),['title' => 'Dummy updated title']);

        $response->assertStatus(200);

        $response->json();

        /* Uncomment to view Response */
        //print_r($response->json());
    }

    /** @test */
    public function delete_data()
    {
        $this->json('POST', route('path.store'), [
            'title'       => 'Dummy title',
            'description' => 'Dummy description'
        ]);

        $data = Data::all()->first();

        $response = $this->json('DELETE', route('path.destroy', $data->id));

        $response->assertStatus(200);

        $response->json();

        /* Uncomment to view Response */
        //print_r($response->json());
    }
}
