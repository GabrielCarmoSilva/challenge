<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
use App\Transaction;
use App\Http\Requests\StorePersonalAccountRequest;
use App\Http\Requests\UpdatePersonalAccountRequest;
use App\Http\Requests\StoreCompanyAccountRequest;
use App\Http\Requests\UpdateCompanyAccountRequest;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Account::with('transactions')->get();
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
    public function storePersonalAccount(StorePersonalAccountRequest $request)
    {
        $account = Account::create([
            'agency' => rand(1000, 9999), //gerando num. aleatorio de 4 digitos
            'number' => rand(10000000, 99999999), //gerando num. aleatorio de 8 digitos
            'digit' => rand(0, 9), //gerando digito aleatorio
            'type' => 'Pessoal',
            'name' => $request->name,
            'cpf' => $request->cpf,
            'user_id' => $request->user_id,
            'balance' => 0, //inicializando saldo como 0
        ]);

        return $account;
    }

    public function storeCompanyAccount(StoreCompanyAccountRequest $request)
    {
        $account = Account::create([
            'agency' => rand(1000, 9999), //gerando num. aleatorio de 4 digitos
            'number' => rand(10000000, 99999999), //gerando num. aleatorio de 8 digitos
            'digit' => rand(0, 9), //gerando digito aleatorio
            'type' => 'Empresarial',
            'social_reason' => $request->social_reason,
            'fantasy_name' => $request->fantasy_name,
            'cnpj' => $request->cnpj,
            'user_id' => $request->user_id,
            'balance' => 0, //inicializando saldo como 0
        ]);

        return $account;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return Account::with('transactions')->find($account);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePersonalAccount(UpdatePersonalAccountRequest $request, Account $account)
    {
        if($account->type == "Empresarial") {
            return response()->json([
                'message' => 'Esta conta é empresarial!'
            ]);
        }
        $account->update($request->all());

        return $account;
    }

    public function updateCompanyAccount(UpdateCompanyAccountRequest $request, Account $account)
    {
        if($account->type == "Pessoal") {
            return response()->json([
                'message' => 'Esta conta é pessoal!'
            ]);
        }
        $account->update($request->all());

        return $account;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return response()->json([
            'message'=> 'Conta excluída com sucesso'
        ]);
    }
}
