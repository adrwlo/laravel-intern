<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Client;


class ClientControllerTest extends TestCase
{
    use RefreshDatabase;
    const CLIENTS_DATA = [
        'name' => 'John', 
        'surname' => 'Doe', 
        'phone' => '123-456-7890', 
        'description' => 'Lorem ipsum'
    ];

    /** @test */
    public function it_can_list_all_clients()
    {
        
        $clients = Client::factory()->count(5)->create(self::CLIENTS_DATA);

        $response = $this->get('/api/client');

        $response->assertStatus(200)
                 ->assertJsonCount(5)
                 ->assertJsonStructure([
                     '*' => ['id', 'name', 'surname', 'phone', 'description']
                 ]);
    }

    /** @test */
    public function it_can_create_a_client()
    {
        $clientData = Client::factory()->create(self::CLIENTS_DATA)->toArray();

        $response = $this->post('/api/client', $clientData);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Client created successfully!'
                 ]);

        $this->assertDatabaseHas('clients', $clientData);
    }

    /** @test */
    public function it_can_show_a_client()
    {
        $client = Client::factory()->create(self::CLIENTS_DATA);

        $response = $this->get('/api/client/' . $client->id);

        $response->assertStatus(200)
                 ->assertJson($client->toArray());
    }

    /** @test */
    public function it_can_update_a_client()
    {
        $client = Client::factory()->create(self::CLIENTS_DATA);
        $updatedClientData = Client::factory()->make()->toArray();

        $response = $this->put('/api/client/' . $client->id, $updatedClientData);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Client updated successfully!'
                 ]);

        $this->assertDatabaseHas('clients', $updatedClientData);
    }

    /** @test */
    public function it_can_delete_a_client()
    {
        $client = Client::factory()->create(self::CLIENTS_DATA);

        $response = $this->delete('/api/client/' . $client->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Client deleted successfully!'
                 ]);

        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
    } 

    /** @test */
    public function it_returns_error_if_client_does_not_exist_when_showing_a_client()
    {
        $response = $this->get('/api/client/1');

        $response->assertStatus(404)
                 ->assertJson([
                     'error' => 'Client not found'
                 ]);
    }

    /** @test */
    public function it_returns_error_if_client_does_not_exist_when_updating_a_client()
    {
        $updatedClientData = Client::factory()->make()->toArray();

        $response = $this->put('/api/client/1', $updatedClientData);

        $response->assertStatus(404)
                 ->assertJson([
                     'error' => 'Client not found'
                 ]);

        $this->assertDatabaseMissing('clients', $updatedClientData);
    }

    /** @test */
    public function it_returns_error_if_client_does_not_exist_when_deleting_a_client()
    {
        $response = $this->delete('/api/client/1');

        $response->assertStatus(404)
                 ->assertJson([
                     'error' => 'Client not found'
                 ]);
    }

    /** @test */
    public function it_returns_error_if_required_fields_are_missing_when_creating_a_client()
    {
        $clientData = [
            'name' => 'John',
            'surname' => 'Doe',
            'phone' => '1234567890',
            'description' => '',
        ];

        $response = $this->post('/api/client', $clientData);

        $response->assertStatus(402)
                 ->assertJson([
                     'error' => 'The given data was invalid.'
                 ]);

        $this->assertDatabaseMissing('clients', $clientData);
    }
}
