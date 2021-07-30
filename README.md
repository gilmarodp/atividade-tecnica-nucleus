# Atividade Técnica Nucleus

## Objetivo
Avaliar capacidade técnica do candidato(a) com as tecnologias requeridas pela
vaga, tais como uso do GIT, framework Laravel, boas práticas e organização de
código.

## Descrição da Atividade
O candidato deve construir aplicação Fullstack em última versão estável do Laravel,
para atender aos requisitos especificados.

## Requisitos
Requisitos
1. Criar o projeto Laravel do zero, utilizando a CLI.
2. Criar API para cadastro de Clientes:
   1. Criar Cliente
   2. Campos:
      1. Nome Completo (Obrigatório)
      2. CPF/CNPJ (Obrigatório)
         1. Deve conter validação
      3. E-mail (Obrigatório)
         1. Deve conter validação
      4. Endereço
         1. CEP (Obrigatório)
            1. Deve conter validação
         2. Logradouro (Obrigatório)
         3. Número (Opcional)
         4. Complemento (Opcional)
         5. Bairro (Obrigatório)
         6. Cidade (Obrigatório)
         7. Estado (Obrigatório)
      5. Observações (Opcional)
3. Listar Todos os Clientes
4. Listar um Cliente
5. Atualizar Cliente
6. Possibilidade de atualizar um ou mais campos da criação do cliente
7. Excluir Cliente
8. Exclusão do cliente a partir de ID fornecido

## Observações
É necessário utilizar as boas práticas ao construir a API, com o uso padronizado dos verbos
HTTP e construção das URI's.

---

## Como utilizar a API?
A API desenvolvida é uma API que basicamente é um CRUD
de Clientes, segue as rotas hospedadas em [https://atividade-tecnica-nucleus.000webhostapp.com](https://atividade-tecnica-nucleus.000webhostapp.com)

Segue as rotas da API desenvolvida


<table>
    <tr>
        <th>Rota</th>
        <th>Verbo</th>
        <th>Descrição</th>
    </tr>
    <tr>
        <td>api/clientes</td>
        <td style="color: green">GET</td>
        <td>Lista todos os clientes</td>
    </tr>
    <tr>
        <td>api/clientes/{id}</td>
        <td style="color: green">GET</td>
        <td>Lista cliente com determinado id</td>
    </tr>
    <tr>
        <td>api/clientes</td>
        <td style="color: #ff9d00">POST</td>
        <td>Cadastra cliente</td>
    </tr>
    <tr>
        <td>api/clientes/{id}</td>
        <td style="color: deepskyblue">PUT</td>
        <td>Edita cliente com determinado id</td>
    </tr>
    <tr>
        <td>api/clientes/{id}</td>
        <td style="color: red">DELETE</td>
        <td>Exclui cliente com determinado id</td>
    </tr>
</table>
