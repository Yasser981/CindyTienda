<?php

namespace App\Services;

use App\Models\Pago;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Illuminate\Support\Facades\Hash;



class PagoService
{

    public function getPago()
    {
        if (\request()->ajax()){
            $data = Pago::all();
            return Datatables::of($data)
                ->addColumn('id',function ($data)
                { 
                    return str_pad($data->id, 4, "0", STR_PAD_LEFT);
                })
                ->addColumn('nombre', function ($data){
                    return $data->nombre;
                })
                ->addColumn('apellido',function ($data){
                    return $data->apellido;
                })
                ->addColumn('cedula',function ($data){
                    return $data->cedula;
                })
                ->addColumn('articulo',function ($data){
                    return $data->articulo;
                })
                ->addColumn('abona', function ($data){
                    $divisa = $data->opcion_divisa === 1 ? 'US$ ':'C$ ';
                    $pago = $data->abona != null?$data->abona: 'N/A';
                    return $pago === 'N/A'?$pago:$divisa.' '.$pago;
                })
                ->addColumn('prima', function ($data){
                    $divisa = $data->opcion_divisa === 1 ? 'US$ ':'C$ ';
                    $pago = $data->prima != null?$data->prima:'N/A';
                    return $pago === 'N/A'?$pago:$divisa.' '.$pago;
                })
                ->addColumn('saldo', function ($data){
                    $divisa = $data->opcion_divisa === 1 ? 'US$ ':'C$ ';
                    return $divisa.' '.$data->saldo;
                })
                ->addColumn('fecha',function ($data){
                    return $data->created_at->isoFormat('Y-M-D h:mm:ss: A');
                })
                ->addColumn('action', function ($data)
                {
                    $eliminar = Auth::user()->is_admin ?'<button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteUserModal" class="btn btn-danger btn-sm" id="getDeleteId" title="Delete"><i class="la la-trash-o"></i>Eliminar</button>':'';

                    return '<button type="button" class="btn btn-primary btn-sm" id="getVerPagoData" data-id="'.$data->id.'" title="Edit"><i class="fa fa-edit"></i>Ver</button>'
                    .' '.$eliminar.'<button type="button" data-id="'.$data->id.'" id="EditarPagoModal" class="btn btn-success btn-sm" title="Editar"><i class="la la-trash-o"></i>Editar</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store($request)
    {
        $divisa = (!empty($request->dolar))?1:0;
        

        if(intval($request->tipo) === 1){
            $save = Pago::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'cedula' => strtoupper($request->cedula),
                'articulo' => $request->articulo,
                'abona' => intval($request->pago),
                'saldo' => intval($request->saldo),
                'opcion_divisa' => $divisa,
            ]);
        }
        else{
            $save = Pago::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'cedula' => strtoupper($request->cedula),
                'articulo' => $request->articulo,
                'prima' => intval($request->pago),
                'saldo' => intval($request->saldo),
                'opcion_divisa' => $divisa,
            ]);
        }

        if ($save->save()) {
            $notify = true; 
        }else{
            $notify = false;
        }

        return $notify;
    }

    public function impresion($save)
    {
            $divisa = $save->opcion_divisa === 1 ? 'US$ ':'C$ ';
            $tipo = $save->abona != null?'Abono '.$divisa.$save->abona:'Prima '.$divisa.$save->prima;
            $nombreImpresora = "ImpresoraTermica";
            $connector = new WindowsPrintConnector($nombreImpresora);
            $impresora = new Printer($connector);
            $impresora->setJustification(Printer::JUSTIFY_CENTER);
            $impresora->setTextSize(1, 1);
            $impresora->text("Variedades Cindy\n");
            $impresora->text("RUC 3211105930004N \n");
            $impresora->text("Teléfono 27222871\n");
            $impresora->text("Dirección: Iglesia Católica 1/2 C. al norte Yalagüina\n");
            $impresora->text("Cajero: ". Auth::user()->name."\n");
            $impresora->text("\n");
            $impresora->text("Recibo de pago #".str_pad($save->id, 4, "0", STR_PAD_LEFT)." \n");
            $impresora->text("\n");
            $impresora->text("Fecha ".$save->created_at->isoFormat('Y-M-D h:mm:ss: A')."\n");
            $impresora->text("\n");
            $impresora->text("Cliente ".$save->nombre." ".$save->apellido."\n");
            $impresora->text("Cédula ".$save->cedula."\n");
            $impresora->text("\n");
            $impresora->text("Artículo  ".$save->articulo."\n");
            $impresora->text("\n");
            $impresora->text($tipo."\n \n"."Saldo ".$divisa.$save->saldo."\n");
            $impresora->text("\n");
            $impresora->text("_______________________________"."\n");
            $impresora->text("Firma \n");
            $impresora->text("\n \n");
            $impresora->text("¡Gracias por preferirnos! \n");
            $impresora->text("\n");
            $impresora->feed(5);
            $impresora->cut();
            $impresora->pulse();
            
            if ($impresora->close() === null){
                return response()->json(['success'=>'El Recivo se esta imprimiendo']);
            }
            else{
                return response()->json(['errors' => 'Hubo un error al al imprimir']);
            }  
    }

    public function update($request,$id)
    {
        $pago = Pago::find(intval($id));
        if(intval($request->tipo) === 1){
            $pago->nombre = $request->nombre;
            $pago->apellido =  $request->apellido;
            $pago->cedula = strtoupper($request->cedula);
            $pago->articulo = $request->articulo;
            $pago->abona =  intval($request->pago);
            $pago->prima = null;
            $pago->saldo = intval($request->saldo);
            $pago->opcion_divisa = intval($request->dolar);        
        }
        else{
            $pago->nombre = $request->nombre;
            $pago->apellido =  $request->apellido;
            $pago->cedula = strtoupper($request->cedula);
            $pago->articulo = $request->articulo;
            $pago->prima =  intval($request->pago);
            $pago->abona =  null;
            $pago->saldo = intval($request->saldo);
            $pago->opcion_divisa = intval($request->dolar);
        }

      
        if ($pago->save()){
            return response()->json(['success'=>'Se actualizo el recivo']);
        }else{
            return response()->json(['errors' => 'Hubo un Error']);
        }
    }

    public function destroy($pago){
        $pago = Pago::find($pago->id);

        if($pago->delete()){
            return response()->json(['success'=>'Se elimino correctamente']);
        } else {
            return response()->json(['error'=>'Se produjo un error cuando se intento eliminar']);
        }
    }

}
