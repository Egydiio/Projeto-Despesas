<?php

namespace App\Http\Controllers;

use App\Http\Requests\DespesaRequest;
use App\Http\Resources\DespesaResource;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Notificacao;
use App\Jobs\sendEmail;
use App\Models\Despesas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DespesasController extends Controller
{
    public function index(){
        $despesa = Despesas::all();
        return DespesaResource::collection($despesa);
    }
    public function store(Request $request) : Response
    {
        try {
            $despesa = new Despesas();
            $despesa->descricao = $request->desc;
            $despesa->data =  Carbon::createFromFormat('Y-m-d',$request->date)->toDateTimeString();       
            $despesa->usuario = auth()->user()->id;
            $despesa->valor = 10.00;
            $despesa->save();

            $usuario = User::find(auth()->user()->id);
            Notification::send( [$usuario], new Notificacao($usuario,$despesa) );

            return Response('ok',200);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id){
        $show = Despesas::find($id);
        return DespesaResource::make($show);
    }

    public function destroy($id){
        $delete = Despesas::find($id);
        $delete->delete();
        return DespesaResource::make($delete);
    }

}
