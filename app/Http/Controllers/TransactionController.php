<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transaction::with('account')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->all();
        if($request->type == "Pagamento de Conta" ||
         $request->type == "Recarga de Celular" ||
         $request->type == "Compra (Crédito)") {
            $request->value > 0 ? $data['value'] = $request->value*-1 : $data['value'] = $request->value;
            /*Interpretei que esses tipos de transação sempre vão retirar saldo da conta,
            e nunca adicionar, então fazendo um tratamento de erro para sempre ser negativo*/
         }
        $transaction = Transaction::create($data);
        $transaction->account->update(['balance' => $transaction->account->balance + $transaction->value]);

        return $transaction;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return $transaction;
    }
}
