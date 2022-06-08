<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portafolio;
use Illuminate\Support\Facades\Storage;

class PortafolioController extends Controller
{

    public function index()
    {
        $portafolios = Portafolio::all();
        return view('portafolio.index',compact('portafolios'));
    }

    public function datosPortafolio()
    {
        $portafolios = Portafolio::all();

        return view('welcome',compact('portafolios'));
    }

    public function create()
    {
        return view ('portafolio.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'nombre'=>'required|max:50',
            'descripcion'=>'required|string|max:50',
            'categoria'=>'required | string | max:15',
            'imagen'=>'required | max:2000 | mimes:jpge,png,jpg',
            'video'=>'required  | max:100',
        ],[
            'required'=>'El campo :attribute es obligatorio',
            'imagen.mimes'=>'La imagen debe ser de tipo: jpge, png, jpg.',
        ]);

        Portafolio::create([
            'nombre'=> request('nombre'),
            'descripcion'=> request('descripcion'),
            'categoria'=> request('categoria'),
            // 'imagen'=> request('imagen'),
            'imagen'=> request()->file('imagen')->store('images','dropbox'),
            'url'=> request('video')
        ]);

        return redirect()->route('portafolio');
    }

    public function show($id)
    {
        $portafolio = Portafolio::find($id);

        return view('portafolio.show',compact('portafolio'));
    }

    public function edit($id)
    {
        $portafolio = Portafolio::find($id);

        return view('portafolio.edit',compact('portafolio'));
    }

    public function update(Portafolio $portafolio)
    {
        // $portafolio->update([
        //     'nombre'=> request('nombre'),
        //     'descripcion'=> request('descripcion'),
        //     'categoria'=> request('categoria'),
        //     'imagen'=> request('imagen'),
        //     'url'=> request('video')
        // ]);

        // return redirect()->route('show',$portafolio);
        if(request()->hasFile('imagen'))
        {
            Storage::disk('dropbox')->delete($portafolio->imagen);

            $portafolio->update([
                'nombre'=> request('nombre'),
                'descripcion'=> request('descripcion'),
                'categoria'=> request('categoria'),
                'imagen'=> request()->file('imagen')->store('images','dropbox'),
                'url'=> request('video')
            ]);
        }
        else
        {
            $portafolio->update([
                'nombre'=> request('nombre'),
                'descripcion'=> request('descripcion'),
                'categoria'=> request('categoria'),
                'url'=> request('video')
            ]);
        }
        return redirect()->route('show',$portafolio);


    }

    public function destroy(Portafolio $portafolio)
    {
        Storage::disk('dropbox')->delete($portafolio->imagen);

        $portafolio ->delete();
        return redirect()->route('portafolio');
    }

}
