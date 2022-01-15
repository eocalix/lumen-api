<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

use Carbon\Carbon;

class LibroController extends Controller{
    
    public function index()
    {
        $datosLibro = Libro::all();

        return response()->json($datosLibro);
    }

    public function guardar(Request $request)
    {
        // return response()->json($request->input('titulo'));
        // return response()->json($request->titulo);
        $datosLibro = new Libro;

        if ($request->hasFile('imagen')) 
        {
            $nombreArchivoOriginal = $request->file('imagen')->getClientOriginalName();
            
            $nuevoNombre = Carbon::now()->timestamp . "_{$nombreArchivoOriginal}";

            $carpetaDestino = './upload/';
            $request->file('imagen')->move($carpetaDestino, $nuevoNombre);

            $datosLibro->titulo = $request->titulo;
            $datosLibro->imagen = ltrim($carpetaDestino, '.') . $nuevoNombre;
            
            $datosLibro->save();
        }
        
        return response()->json($nuevoNombre);
    }

    public function ver($id) 
    {
        $datosLibro = new Libro;

        $datosEncontrados = $datosLibro->find($id);

        return response()->json($datosEncontrados);
    }

    public function eliminar($id)
    {
        $datosLibro = Libro::find($id);

        if ($datosLibro) 
        {
            $rutaArchivo = base_path('public') . $datosLibro->imagen;

            if (file_exists($rutaArchivo)) 
            {
                unlink($rutaArchivo);
            }

            $datosLibro->delete();
        }

        //return response($id);
        return response()->json("Registro borrado");
    }

    public function actualizar(Request $request, $id)
    {
        $datosLibro = Libro::find($id);

        if ($request->input('titulo')) 
        {
            $datosLibro->titulo = $request->input('titulo');
        }

        if ($request->hasFile('imagen')) 
        {
            $rutaArchivo = base_path('public') . $datosLibro->imagen;

            if (file_exists($rutaArchivo)) 
            {
                unlink($rutaArchivo);
            }

            $nombreArchivoOriginal = $request->file('imagen')->getClientOriginalName();
            
            $nuevoNombre = Carbon::now()->timestamp . "_{$nombreArchivoOriginal}";

            $carpetaDestino = './upload/';
            $request->file('imagen')->move($carpetaDestino, $nuevoNombre);

            $datosLibro->imagen = ltrim($carpetaDestino, '.') . $nuevoNombre;
            
        }

        $datosLibro->save();
            return response()->json("Datos actualizados");
    }

}