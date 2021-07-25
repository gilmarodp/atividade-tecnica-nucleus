<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome_completo' => $this->nome_completo,
            'cpf_ou_cnpj' => $this->cpf_ou_cnpj,
            'email' => $this->email,
            'endereco' => new EnderecoResource($this->endereco),
            'observacoes' => $this->observacoes,
            'created_at' => date('d/m/Y', strtotime($this->created_at)),
        ];
    }
}
