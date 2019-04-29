<?php

namespace Tests\Feature;

use App\Data;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DataTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function show_all_data()
    {
        $data = factory(Data::class, 10)->create();

        $response = $this->get(route('path.index'));

        $response->assertStatus(200);

        $response->assertJson($data->toArray());
    }

    /** @test */
    public function create_data()
    {
        $response = $this->post(route('path.store'), [
            'title'       => 'Dummy title',
            'description' => 'Dummy description'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('data', ['title' => 'Dummy title']);

        $response->assertJsonStructure(['message',
            'data' =>
                ['title',
                    'description',
                    'updated_at',
                    'created_at',
                    'id'
                ]]);
    }

    /** @test */
    public function show_data()
    {
        $this->post(route('path.store'), [
            'title'       => 'Dummy title',
            'description' => 'Dummy description'
        ]);

        $data = Data::all()->first();

        $response = $this->get(route('path.show', $data->id));

        $response->assertStatus(200);
        $response->assertJsonStructure(['message',
            'data' =>
                ['title',
                    'description',
                    'updated_at',
                    'created_at',
                    'id'
                ]]);
    }

    /** @test */
    public function update_data()
    {
        $this->post(route('path.store'), [
            'title'       => 'Dummy title',
            'description' => 'Dummy description'
        ]);

        $data = Data::all()->first();

        $response = $this->put(route('path.update', $data->id), ['title' => 'Dummy updated title']);

        $response->assertStatus(200);

        $response->assertJsonStructure(['message']);
    }

    /** @test */
    public function delete_data()
    {
        $this->post(route('path.store'), [
            'title'       => 'Dummy title',
            'description' => 'Dummy description'
        ]);

        $data = Data::all()->first();

        $response = $this->delete(route('path.destroy', $data->id));

        $response->assertJsonStructure([
            'message'
        ]);
    }
}
