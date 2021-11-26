<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PagoService;
use Carbon\Carbon;
class PagosDatatableController extends Controller
{

    public function __construct()
    {
        Carbon::setLocale('es');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return (new PagoService())->getPago();
    }
}
