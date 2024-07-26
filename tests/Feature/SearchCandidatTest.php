<?php

use App\Models\Candidat;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can search candidat by matricule', function () {
    $candidat = Candidat::factory()->create([
        'matricule' => '9471153',
        'fname' => 'Sambatra',
        'lname' => 'RATSITONONINA',
        'serie' => 'A1',
        'mention' => 'Passable',
        'center' => 'BETIOKY SUD',
        'admis' => true,
    ]);

    $response = $this->postJson('/api/search', ['matricule' => '9471153']);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'data' => [
            'current_page',
            'data' => [
                [
                    'matricule', 'fname', 'lname', 'serie', 'mention', 'center', 'admis'
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ]
    ]);
    $response->assertJsonFragment([
        'matricule' => '9471153',
        'fname' => 'Sambatra',
        'lname' => 'RATSITONONINA',
        'serie' => 'A1',
        'mention' => 'Passable',
        'center' => 'BETIOKY SUD',
        'admis' => true,
    ]);
});

it('can search candidats by name', function () {
    $candidat1 = Candidat::factory()->create([
        'matricule' => '9471153',
        'fname' => 'Sambatra',
        'lname' => 'RATSITONONINA',
        'serie' => 'A1',
        'mention' => 'Passable',
        'center' => 'BETIOKY SUD',
        'admis' => true,
    ]);

    $candidat2 = Candidat::factory()->create([
        'matricule' => '9868306',
        'fname' => 'Valiha',
        'lname' => 'RATSITONONINA',
        'serie' => 'A2',
        'mention' => '-',
        'center' => 'ANALAVORY',
        'admis' => false,
    ]);

    $response = $this->postJson('/api/search', ['nom' => 'RATSITONONINA']);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'data' => [
            'current_page',
            'data' => [
                [
                    'matricule', 'fname', 'lname', 'serie', 'mention', 'center', 'admis'
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ]
    ]);
    $response->assertJsonFragment([
        'matricule' => '9471153',
        'fname' => 'Sambatra',
        'lname' => 'RATSITONONINA',
        'serie' => 'A1',
        'mention' => 'Passable',
        'center' => 'BETIOKY SUD',
        'admis' => true,
    ]);
    $response->assertJsonFragment([
        'matricule' => '9868306',
        'fname' => 'Valiha',
        'lname' => 'RATSITONONINA',
        'serie' => 'A2',
        'mention' => '-',
        'center' => 'ANALAVORY',
        'admis' => false,
    ]);
});

it('returns error for invalid request without matricule or nom', function () {
    $response = $this->postJson('/api/search', []);

    $response->assertStatus(400);
    $response->assertJson([
        'status' => 400,
        'message' => 'Invalid request'
    ]);
});

it('returns empty data when no candidat is found', function () {
    $response = $this->postJson('/api/search', ['nom' => 'NonExistentName']);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'data' => [
            'current_page',
            'data',
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ]
    ]);
    $response->assertJsonFragment([
        'data' => []
    ]);
});

it('can paginate search results', function () {
    Candidat::factory()->count(15)->create(['lname' => 'RATSITONONINA']);

    $response = $this->postJson('/api/search', ['nom' => 'RATSITONONINA']);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'status',
        'data' => [
            'current_page',
            'data' => [
                '*' => [
                    'matricule', 'fname', 'lname', 'serie', 'mention', 'center', 'admis'
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ]
    ]);
});
