<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClienteResource;
use App\Models\Cliente;
use App\Models\Endereco;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::paginate(15);

        return ClienteResource::collection($clientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome_completo' => 'required|unique:clientes|max:255',
            'cpf_ou_cnpj' => 'required|unique:clientes|cpf_ou_cnpj|formato_cpf_ou_cnpj',
            'email' => 'required|unique:clientes|email',
            'cep' => 'required|formato_cep',
            'logradouro' => 'required',
            'numero' => '',
            'complemento' => '',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'observacoes' => ''
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {
            $cliente = new Cliente();
            $cliente->nome_completo = $request->nome_completo;
            $cliente->cpf_ou_cnpj = $request->cpf_ou_cnpj;
            $cliente->email = $request->email;
            $cliente->observacoes = $request->observacoes;
            $cliente->save();

            $endereco = new Endereco();
            $endereco->cep = $request->cep;
            $endereco->logradouro = $request->logradouro;
            $endereco->numero = $request->numero;
            $endereco->complemento = $request->complemento;
            $endereco->bairro = $request->bairro;
            $endereco->cidade = $request->cidade;
            $endereco->estado = $request->estado;
            $endereco->cliente_id = $cliente->id;
            $endereco->save();

            return new ClienteResource($cliente);
        } catch (ValidationException $e) {
            return response()->json($e->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return new ClienteResource($cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validator = Validator::make($request->all(), [
            'nome_completo' => 'unique:clientes,nome_completo,' . $cliente->id . '|max:255',
            'cpf_ou_cnpj' => 'unique:clientes,cpf_ou_cnpj,' . $cliente->id . '|cpf_ou_cnpj|formato_cpf_ou_cnpj',
            'email' => 'unique:clientes,email,' . $cliente->id . '|email',
            'cep' => 'formato_cep',
            'logradouro' => '',
            'numero' => '',
            'complemento' => '',
            'bairro' => '',
            'cidade' => '',
            'estado' => '',
            'observacoes' => ''
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        array_filter($request->all());
        $clienteRequest = $request->all();
        $enderecoRequest = $request->all();

        unset($clienteRequest['cep']);
        unset($clienteRequest['logradouro']);
        unset($clienteRequest['numero']);
        unset($clienteRequest['complemento']);
        unset($clienteRequest['bairro']);
        unset($clienteRequest['cidade']);
        unset($clienteRequest['estado']);

        unset($enderecoRequest['nome_completo']);
        unset($enderecoRequest['cpf_ou_cnpj']);
        unset($enderecoRequest['email']);
        unset($enderecoRequest['observacoes']);

        $cliente->update($clienteRequest);

        $endereco = (new Endereco())::where('cliente_id', $cliente->id)->first();
        $endereco->update($enderecoRequest);

        return new ClienteResource($cliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return response()->json([
            'Cliente deletado com sucesso!!!'
        ]);
    }
}
