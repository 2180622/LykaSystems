<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function redirecionar_de_dashboard_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clients')->assertRedirect('/login');
    }
    
    public function redirecionar_de_show_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    public function redirecionar_de_create_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    public function redirecionar_de_store_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    public function redirecionar_de_edit_cliente_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    public function redirecionar_de_update_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
}
