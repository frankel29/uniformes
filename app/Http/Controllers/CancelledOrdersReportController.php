<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class CancelledOrdersReportController extends Controller
{
    public function downloadPdf()
    {
        // Obtener las órdenes canceladas
        $cancelledOrders = Order::where('status', 'cancelled')->get();

        // Calcular el total de órdenes canceladas
        $totalCancelled = $cancelledOrders->sum('grand_total');

        // Generar el PDF con los datos
        $pdf = Pdf::loadView('cancelled-orders-pdf', compact('cancelledOrders', 'totalCancelled'));

        return $pdf->download('reporte_ventas_canceladas.pdf');
    }
}
