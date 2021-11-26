<?php

namespace App\Services;

use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;



class UserService
{

    public function getUser()
    {
        if (\request()->ajax()){
            $data = User::all();
            return Datatables::of($data)
            ->addColumn('id',function ($data)
            {
               return $data->id;
            })
            ->addColumn('name', function ($data)
            {
               return $data->name;
            })
            ->addColumn('email', function ($data)
            {
               return $data->email;
            })
            ->addColumn('is_admin', function ($data)
            {
               return $data->is_admin === 1 ? 'Administrador' : 'Colaborador';
            })
            ->addColumn('action', function ($data)
            {
                return '<button type="button" class="btn btn-primary btn-sm" id="getEditUserData" data-id="'.$data->id.'" title="Edit"><i class="fa fa-edit"></i>Editar</button>
                <button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeletePagoModal" class="btn btn-danger btn-sm" id="getDeleteId" title="Delete"><i class="la la-trash-o"></i>Eliminar</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function store($request)
    {
        $saved = User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => intval($request->admin),
        ]);

        if ($saved) {
          $notify = true;
        }else{
            $notify = false;
        }

        return  $notify;
    }

    public function update($request,$id)
    {
        $user = User::find(intval($id));
        if (!empty($request->password)){
            $user->name = $request->nombre;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_admin = intval($request->admin);
        }
        else{
            $user->name = $request->nombre;
            $user->email = $request->email;
            $user->is_admin = intval($request->admin);
        }
        if ($user->save()){
            return response()->json(['success'=>'El usuario se actualizo correctamente']);
        }else{
            return response()->json(['errors' => 'Hubo un error al actualizar el usuario']);
        }
    }

    public function destroy($id){

        $user = User::find($id);

        if($user->delete()){
            return response()->json(['success'=>'Se elimino correctamente']);
        } else {
            return response()->json(['error'=>'Se produjo un error cuando se intento eliminar']);
        }
    }

}
