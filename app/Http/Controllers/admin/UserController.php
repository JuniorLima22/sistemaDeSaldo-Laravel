<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile()
    {
        $recarga = auth()->user()->historics()->where('type', 'I')->sum('amount');
        $saque = auth()->user()->historics()->where('type', 'O')->sum('amount');
        $transferencia = auth()->user()->historics()->where('type', 'T')->count();

        return view('site.profile.profile', compact('recarga', 'saque', 'transferencia'));
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        
        $data = $request->all();

        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }

        if (isset($data['delete_image'])) {
            $data['image'] = null;
            Storage::delete('users/'.$user->image);
        }else{
            $data['image'] = $user->image;
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $name = $user->id.'-'.kebab_case($user->name);

            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";
            $data['image'] = $nameFile;
            
            $upload = $request->image->storeAs('users', $nameFile);
            
            if (!$upload) {
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload da imagem.');
            }
        }

        $update = $user->update($data);

        if ($update) {
            return redirect()
                        ->route('profile')
                        ->with('success', 'Sucesso ao atualizar perfil!');
        }

        return redirect()
                    ->back()
                    ->with('error', 'Falha ao atualizar perfil...');
        
    }
}
