<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portafolio;

class PortafolioController extends Controller
{

    public function index()
    {
        $portafolios = Portafolio::all();
        return view('portafolio.index',compact('portafolios'));
    }

    public function create()
    {
        return view ('portafolio.create');
    }

    public function store(Request $request)
    {
        Portafolio::create([
            'nombre'=> request('nombre'),
            'descripcion'=> request('descripcion'),
            'categoria'=> request('categoria'),
            'imagen'=> request('imagen'),
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
        $portafolio->update([
            'nombre'=> request('nombre'),
            'descripcion'=> request('descripcion'),
            'categoria'=> request('categoria'),
            'imagen'=> request('imagen'),
            'url'=> request('video')
        ]);

        return redirect()->route('show',$portafolio);
    }

    public function destroy(Portafolio $portafolio)
    {
        $portafolio ->delete();
        return redirect()->route('portafolio');
    }

}
