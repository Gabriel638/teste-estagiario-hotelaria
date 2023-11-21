<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Quarto;
use App\Models\Reserva;
use App\Models\Cliente;


class QuartoController extends Controller
{
    // Método para listar todos os quartos
    public function listarQuartos()
    {

    $quartos = Quarto::all();

    return view('quartos.index', ['quartos' => $quartos]);
    }

    // Método para listar quartos disponíveis
    public function listarDisponiveis()
    {

        $quartosDisponiveis = Quarto::where('disponivel', true)->get();

        return view('quartos.index', ['quartos'=> $quartosDisponiveis]);
    }

     // Método para exibir o formulário de criação de quartos
    public function criarQuartos()
    {
        return view('quartos.criar');
    }

    // Método para processar o formulário de criação e guardar um quarto
    public function guardar(Request $request)
    {
        Quarto::create($request->all());
        return redirect()->route('quartos-listar');
    }

    // Método para exibir o formulário de edição de quartos
    public function editarQuartos($id)
    {
        $quartos = Quarto::where('id', $id)->first();
        if(!empty($quartos))
        {
            return view('quartos.editar', ['quartos'=> $quartos]);
        }
        else{
            return redirect()->route('quartos-listar');
        }

    }

    // Método para atualizar as informações de um quarto
    public function atualizar(Request $request, $id)
    {

        $informacoes = [
            'numero' => $request->numero,
            'capacidade' => $request->capacidade,
            'preco_diaria' => $request->preco_diaria,
            'disponivel' => $request->has('disponivel') ? true : false,
        ];
        Quarto::where('id', $id)->update($informacoes);
        return redirect()->route('quartos-listar');
    }

    // Método para excluir um quarto
    public function excluir($id)
    {
        Quarto::where('id', $id)->delete();
        return redirect()->route('quartos-listar');
    }

    // Método para listar todas as reservas
    public function listarReservas()
    {

    $reservas = Reserva::all();
    $clientes = Cliente::all();

    return view('reservas.index', ['reservas' => $reservas, 'clientes' => $clientes]);
    }

    // Método para exibir o formulário de criação de reservas
    public function criarReservas()
    {
        $quartos = Quarto::where('disponivel', true)->get();
        $clientes = Cliente::all();

        return view('reservas.criar')->with('quartos', $quartos)->with('clientes', $clientes);
    }

    // Método para processar o formulário de criação e guardar uma reserva
    public function guardarReservas(Request $request)
    {
        $reserva = Reserva::create($request->all());

        // Atualiza a disponibilidade do quarto na tabela Quarto
        $quarto = Quarto::find($request->quarto_id);
        if ($quarto) {
            $quarto->disponivel = false;
            $quarto->save();
        }

        return redirect()->route('reservas-listar');
    }


    // Método para listar reservas com base em datas fornecidas
    public function reservasPorData(Request $request)
    {
        $clientes = Cliente::all();
        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');

        // Verifica se os campos de data estão preenchidos
        if (empty($dataInicio) || empty($dataFim)) {
            return redirect()->route('reservas-listar');
        }

        // Constrói a consulta com base nos parâmetros fornecidos
        $query = Reserva::where(function ($query) use ($dataInicio, $dataFim) {
            $query->where('data_checkin', '>=', $dataInicio)
                ->where('data_checkin', '<=', $dataFim);
        })->orWhere(function ($query) use ($dataInicio, $dataFim) {
            $query->where('data_checkout', '>=', $dataInicio)
                ->where('data_checkout', '<=', $dataFim);
        });

        $reservas = $query->get();

        return view('reservas.index', ['reservas' => $reservas, 'clientes' => $clientes]);
    }

    // Método para listar reservas de um cliente específico
    public function reservasPorCliente(Request $request)
    {
        $clienteId = $request->input('cliente_id');
        $clientes = Cliente::all();

        // Verifica se o ID do cliente foi fornecido
        if (!$clienteId) {
            return redirect()->route('reservas-listar')->with('error', 'ID do cliente não fornecido.');
        }

        // Criar uma instância do modelo Reserva
        $reservaModel = new Reserva();

        // Obtém as reservas do cliente usando o método do modelo
        $reservasDoCliente = $reservaModel->reservasPorCliente($clienteId);


        return view('reservas.index', ['reservas' => $reservasDoCliente, 'clientes' => $clientes]);
    }


    // Método para exibir o formulário de edição de reservas
    public function editarReservas($id)
    {
        $reservas = Reserva::where('id', $id)->first();
        if (!empty($reservas)) {
            $clientes = Cliente::all();
            $quartos = Quarto::all();
            $quartoSelecionadoId = $reservas->quarto_id;
            $quartoSelecionado = Quarto::find($quartoSelecionadoId);

            return view('reservas.editar', ['reservas' => $reservas, 'quartos' => $quartos, 'quartoSelecionadoId' => $quartoSelecionadoId, 'quartoSelecionado' => $quartoSelecionado, 'clientes' => $clientes]);
        } else {
            return redirect()->route('reservas-listar');
        }
    }

    // Método para atualizar as informações de uma reserva
    public function atualizarReservas(Request $request, $id)
    {
        $informacoesReservas = [
            'cliente_id' => $request->cliente_id,
            'quarto_id' => $request->quarto_id,
            'data_checkin' => $request->data_checkin,
            'data_checkout' => $request->data_checkout,
        ];

        Reserva::where('id', $id)->update($informacoesReservas);

        // Atualiza a disponibilidade do quarto na tabela Quarto
        $quarto = Quarto::find($request->quarto_id);
        if ($quarto) {
            $quarto->disponivel = false;
            $quarto->save();
        }

        return redirect()->route('reservas-listar');
    }

    // Método para excluir uma reserva
    public function excluirReservas($id)
    {
        $reserva = Reserva::find($id);

        // Obtém o quarto associado à reserva antes de excluí-la
        $quarto = Quarto::find($reserva->quarto_id);

        Reserva::where('id', $id)->delete();

        // Atualiza a disponibilidade do quarto na tabela Quarto
        if ($quarto) {
            $quarto->disponivel = true;
            $quarto->save();
        }

        return redirect()->route('reservas-listar');
    }

    // Método para listar todos os clientes
    public function listarClientes()
    {

    $clientes = Cliente::all();

    return view('clientes.index', ['clientes' => $clientes]);
    }

    // Método para exibir o formulário de criação de clientes
    public function criarClientes()
    {
        return view('clientes.criar');
    }

    // Método para processar o formulário de criação e guardar um cliente
    public function guardarClientes(Request $request)
    {
        Cliente::create($request->all());
        return redirect()->route('clientes-listar');
    }

    // Método para exibir o formulário de edição de clientes
    public function editarClientes($id)
    {
        $clientes = Cliente::where('id', $id)->first();
        if(!empty($clientes))
        {
            return view('clientes.editar', ['clientes'=> $clientes]);
        }
        else{
            return redirect()->route('clientes-listar');
        }

    }

    // Método para atualizar as informações de um cliente
    public function atualizarClientes(Request $request, $id)
    {

        $informacoesclientes = [
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
        ];
        Cliente::where('id', $id)->update($informacoesclientes);
        return redirect()->route('clientes-listar');
    }

    // Método para excluir um cliente
    public function excluirClientes($id)
    {
        Cliente::where('id', $id)->delete();
        return redirect()->route('clientes-listar');
    }

}
