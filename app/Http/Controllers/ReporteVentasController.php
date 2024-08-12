<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use PDF;

class ReporteVentasController extends Controller
{
    public function descargarPDF()
    {
        // Configura el idioma de Carbon para asegurar que las fechas se traduzcan
        Carbon::setLocale(config('app.locale'));

        // Obtener los datos de las ventas
        $ventas = Order::with('items.product')
            ->get()
            ->groupBy(function($order) {
                // Usa translatedFormat para obtener el nombre del mes en español
                return $order->created_at->translatedFormat('F Y');
            });

        // Calcular el total de las ventas
        $totalVentas = Order::sum('grand_total');

        // Cargar la vista del PDF con los datos
        $pdf = PDF::loadView('reporte-ventas-pdf', [
            'ventas' => $ventas,
            'totalVentas' => $totalVentas,
        ]);

        return $pdf->download('reporte_ventas.pdf');
    }
}

