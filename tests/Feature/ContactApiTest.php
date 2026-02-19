<?php

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

//uses(RefreshDatabase::class);



it('returns a list of contacts', function () {
   $response = $this->get('/api/v1/contacts');
   $response->assertStatus(200);

   $response->assertJsonStructure([
       '*' => [
           'id',
           'given_name',
           'family_name',
           'nick_name',
           'title'
       ]
   ]);
});

it('returns a single contact', function () {
    $response = $this->get('/api/v1/contacts/1');
    $response->assertStatus(200);
    $response->assertJsonStructure(
        ['id', 'given_name', 'family_name', 'nick_name', 'title']
    );
});

it('returns a newly created contact', function () {
   $attributes = Contact::factory()->raw();

   $response = $this->post('/api/v1/contacts', $attributes);
   $response->assertStatus(201)
            ->assertJsonStructure(
                ['id', 'given_name', 'family_name', 'nick_name', 'title']
   );
   $this->assertDatabaseHas('contacts', $attributes);
});

// TODO: Create the missing given name when creating a contact test
it('returns create contact error when missing given name', function () {
    $response = $this->putJson('/api/v1/contacts/1', [
        'id' => '',
        //'given_name' => 'John',//
        'family_name' => '',
        'nick_name' => '',
        'title' => '',

    ]);
    $response->assertStatus(422)
             ->assertJsonValidationErrors(['given_name']);

});

// TODO: Create the update contact test
it('returns an updated contact', function () {
    $attributes = Contact::factory()->raw();
    $response = $this->patch('/api/v1/contacts/1', $attributes);
    $response->assertStatus(200)
        ->assertJsonStructure(
            ['id', 'given_name', 'family_name', 'nick_name', 'title']
        );
});

// TODO: Create the delete contact test
it('returns a deleted contact', function () {
    $attributes = Contact::factory()->raw();
    $response = $this->delete('/api/v1/contacts/1', $attributes);
    $response->assertStatus(200)
    ;
});
