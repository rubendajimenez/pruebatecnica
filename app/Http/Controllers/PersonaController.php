<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use DB;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $persona = Persona::all();
        //SELECT p.*,GROUP_CONCAT( t.numero) as telefonos FROM `persona` p
        // inner join telefono t on t.idpersona = p.idpersona
        // GROUP BY (p.idpersona)

        // $persona  = Db::select("select p.*,group_concat(t.numero) as telefonos FROM persona p
        //                        inner join telefono t on t.idpersona = p.idpersona 
        //                        group by p.idpersona,p.nombre,p.apellidopaterno,p.apellidomaterno,p.ci,p.direccion
        //                        ");

        return view('persona.index')->with('persona',$persona);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('persona.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $persona = new Persona();
        $persona->nombre=$request->get('nombre');
        $persona->apellidopaterno=$request->get('apellidopaterno');
        $persona->apellidomaterno=$request->get('apellidomaterno');
        $persona->ci=$request->get('ci');
        $persona->direccion=$request->get('direccion');
        $persona->save();

        return redirect('/persona');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona = Persona::find($id);
        return view('persona.edit')->with('persona',$persona);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $persona =  Persona::find($id);
        $persona->nombre=$request->get('nombre');
        $persona->apellidopaterno=$request->get('apellidopaterno');
        $persona->apellidomaterno=$request->get('apellidomaterno');
        $persona->ci=$request->get('ci');
        $persona->direccion=$request->get('direccion');
        $persona->save();

        return redirect('/persona');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona =  Persona::find($id);
        $persona->delete();
        return redirect('/persona');
    }
}
