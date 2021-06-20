<?php

namespace App\Http\Controllers;

use App\PersonalAccount;
use App\User;
use App\Account;
use Illuminate\Http\Request;
use App\Http\Requests\StorePersonalAccountRequest;
use App\Http\Requests\UpdatePersonalAccountRequest;

class PersonalAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PersonalAccount::with('account')->get();
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
    public function store(StorePersonalAccountRequest $request)
    {
        $user = User::findOrFail($request->user_id);
        if(!$user->account()->exists()) { //verificando se o usuario ja possui uma conta e criando caso nao tenha
            $user->account()->create([
                'agency' => rand(1000, 9999), //gerando num. aleatorio de 4 digitos
                'number' => rand(10000000, 99999999), //gerando num. aleatorio de 8 digitos
                'digit' => rand(0, 9), //gerando digito aleatorio
            ]);
        }
        
        $user->account->personalAccount()->create([ //criando conta pessoal associada à conta
            'name' => $request->name,
            'cpf' => $request->cpf
        ]);

        return $user->account->personalAccount()->with('account')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PersonalAccount  $personalAccount
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalAccount $personalAccount)
    {
        return $personalAccount->with('account')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalAccount  $personalAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalAccount $personalAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonalAccount  $personalAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonalAccountRequest $request, PersonalAccount $personalAccount)
    {
        $user = $personalAccount->account->user;
        $user->account->personalAccount()->update([ //editando conta pessoal associada à conta
            'name' => $request->name,
            'cpf' => $request->cpf
        ]);

        return $personalAccount->with('account')->get();;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonalAccount  $personalAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalAccount $personalAccount)
    {
        $personalAccount->delete();

        return response()->json([
            'message'=> 'Conta pessoal excluída com sucesso'
        ]);
    }
}
