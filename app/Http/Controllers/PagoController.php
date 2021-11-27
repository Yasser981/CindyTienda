<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Http\Requests\PagoRequest;
use App\Services\PagoService;
use Carbon\Carbon;

class PagoController extends Controller
{
    private $pago;

    public function __construct(PagoService $pago)
    {
        Carbon::setLocale('es');
        $this->pago = $pago;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pagos.index');
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
     * @param  \App\Http\Requests\StorePagoRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PagoRequest $request)
    {
        $notify = $this->pago->store($request);
        $notify == true? notify()->success('Se registro el pago'): drakify('error');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        $divisa = $pago->opcion_divisa === 1?'US$ ':'C$ ';
        $html = view('pagos.modal-field', compact('pago','divisa'))->render();
        return response()->json(['html'=>$html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Pago $pago)
    {
        $divisa = $pago->opcion_divisa === 1?'US$ ':'C$ ';
        $html = view('pagos.modal-pago-file', compact('pago','divisa'))->render();
        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePagoRequest  $request
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(PagoRequest $request, $pago)
    {
        return $this->pago->update($request, $pago);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        return $this->pago->destroy($pago);
    }
}
