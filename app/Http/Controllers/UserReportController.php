<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UserReportController extends Controller
{
    public function download()
    {
        // Obtén todos los usuarios
        $users = User::all();
        $totalUsers = $users->count();

        // Carga la vista para el PDF
        $pdf = Pdf::loadView('user-report', [
            'users' => $users,
            'totalUsers' => $totalUsers
        ]);

        // Retorna el PDF como descarga
        return $pdf->download('reporte_usuarios.pdf');
    }
}
