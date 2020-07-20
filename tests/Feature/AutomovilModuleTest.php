<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AutomovilModuleTest extends TestCase{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPostQuoting(){
        $this->withoutExceptionHandling();
        		
		$this->post('/api/quoting',[ 
		    'depto' => 'antioquia',
			'marca' => 'renault',
            'modelo' => 'sandero',
            'anio' => '2016',            
		])->assertStatus(201)
          ->assertSee('kilometraje');          
    }
}
