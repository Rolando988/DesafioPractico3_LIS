<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados']=Empleado::paginate(7);
        return view('empleado.index',$datos);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
      //  $datosEmpleado = request()->all();
      $campos=[
          'Nombre'=>'required|string|max:100',
          'ApellidoPaterno'=>'required|string',
          'ApeliidoMaterno'=>'required|string',
          'Correo'=>'required|string',
          'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',

        ];
        $mensaje=[
            'required'=> 'El :attribute es requerido',
           'ApellidoPaterno.required'=> 'El Tipo es requerido',
            'ApeliidoMaterno.required'=> 'Los Ingredientes son requeridos',
            'Correo.required'=> 'La Preparacion es requerida',
            
            'Foto.required'=> 'La foto es requerida'
        ];

        $this->validate($request, $campos, $mensaje);




      $datosEmpleado = request()->except('_token');
      if ($request->hasFile('Foto')) {
          $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
      }



      Empleado::insert($datosEmpleado);
      //return response()->json($datosEmpleado);
    return redirect('empleado')->with('mensaje','Receta agregada con exito');
  
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleado=Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'Nombre'=>'required|string',
            'ApellidoPaterno'=>'required|string',
            'ApeliidoMaterno'=>'required|string',
            'Correo'=>'required|string',
            
  
          ];
          $mensaje=[
              'required'=> 'El :attribute es requerido',
             'ApellidoPaterno.required'=> 'El Tipo es requerido',
              'ApeliidoMaterno.required'=> 'Los Ingredientes son requeridos',
              'Correo.required'=> 'La Preparacion es requerida',
              
          ];
          if ($request->hasFile('Foto')) {
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=> 'La foto es requerida'];
        
        }
       

  
          $this->validate($request, $campos, $mensaje);


        //
        $datosEmpleado = request()->except(['_token','_method']);

        if ($request->hasFile('Foto')) {
            $empleado=Empleado::findOrFail($id);

            Storage::delete('public/'.$empleado->Foto);

            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }


        Empleado::where('id','=', $id)->update($datosEmpleado);

        $empleado=Empleado::findOrFail($id);
        //return view('empleado.edit', compact('empleado'));
        return redirect('empleado')->with('mensaje','Receta Modificada');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $empleado=Empleado::findOrFail($id);
        if (Storage::delete('public/'.$empleado->Foto)) {
            
            Empleado::destroy($id);
        }



       

         return redirect('empleado')->with('mensaje','Receta Borrada');
    }
}
