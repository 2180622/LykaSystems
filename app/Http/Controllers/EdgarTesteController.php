<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\ExtraFunctionsController;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Carbon\Carbon;
// use App\Http\Controllers\AdministradorC

class EdgarTesteController extends Controller
  {
    /*public function index()
    {
        if(!Auth()->user()){
          $user = User::first();
          do{
            if($user){
              Auth::login($user[0], true);
            }else{
              ExtraFunctionsController::createData();
            }
          }while(!Auth()->user());
        }
        if(Auth()->user()){
          $notificacoes = ExtraFunctionsController::getNotificacoes();
        }
        return view('edgarteste.teste');
    }/** Teste 1 */


    protected $Extrafuntions;
    public function __construct(ExtraFunctionsController $Extrafuntions)
    {
      $this->Extrafuntions = $Extrafuntions;
    }
    public function index()
    {
        if(!Auth()->user()){
          $user = User::first();
          do{
            if($user){
              Auth::login($user[0], true);
            }else{
              $this->Extrafuntions->createData();
            }
          }while(!Auth()->user());
        }
        if(Auth()->user()){
          $notificacoes = $this->Extrafuntions->getNotificacoes();
        }
        return view('edgarteste.teste');
    }/** Teste 2 */



    
    
    public function create()
    {
      $user = new User;
      $admin = new Administrador;
      $agente = new Agente;
      $cliente = new Cliente;

      return view('users.add', compact('user', 'admin', 'agente', 'cliente', 'storeAdmin', 'storeAgente', 'storeCliente'));
    }

}
