<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
Use App\Models\User;

class UserController extends Controller
{
    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        
        $data = $request->all();

       // dd($data);

        if($data['password'] != null)
            $data['password'] = bcrypt($data['password']);

        else
            unset($data['password']); // password nao pode ser nulo entao deletamos

        $data['image'] = $user->image;

        // verificando se carregou uma imagem com o hasFile()
        // e se o arquivo é valido com o isValid
        // antes de carregar a imagem

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
          
          //cria um nome para a imagem concatenado id e nome do user
                    $name = 'imagem_user_'.$user->id;   // tirar os espacos com o kebab_case
                    $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                    $nameFile = "{$name}.{$extenstion}"; // concatenando
                    $data['image'] = $nameFile;
       


            $upload = $request->file('image')->storeAs('users', $nameFile); // fazendo o upload

                                                // users será o nome da pasta que armazena a imagem

            if (!$upload)
                return redirect() 
                            ->back()
                            ->with('error', 'Falha ao fazer o upload');

        }

        $update = $user->update($data);

        if ($update)

        return redirect()
                        ->route('Users.useradd')
                        ->with('sucess', 'Sucesso ao atualizar');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao atualizar o perfil');

    }
}
