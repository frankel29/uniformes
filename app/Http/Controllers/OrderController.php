<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Asegúrate de tener el alias para DomPDF
use App\Helpers\CartManagement; // Importa la clase CartManagement

class OrderController extends Controller
{
    public function generatePDF(Request $request)
    {
        // Obtener datos de la solicitud y carrito
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $city = $request->input('city');

        $cartItems = CartManagement::getCartItemsFromCookie();
        $grandTotal = CartManagement::calculateGrandTotal($cartItems);

        // Crear el array de datos a pasar a la vista
        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'cart_items' => $cartItems,
            'grand_total' => $grandTotal,
        ];

        // Generar el PDF
        $pdf = PDF::loadView('invoice', $data);

        // Descargar el PDF con un nombre dinámico basado en el nombre del cliente
        return $pdf->download('invoice_' . $firstName . '_' . $lastName . '.pdf');
    }
}

