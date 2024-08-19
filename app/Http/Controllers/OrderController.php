<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Helpers\CartManagement;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function generatePDF(Request $request)
    {
        // Obtener datos de la solicitud y carrito
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $phone = $request->input('phone');
        $city = $request->input('city');

        $cartItems = CartManagement::getCartItemsFromCookie();
        $grandTotal = CartManagement::calculateGrandTotal($cartItems);

        // Crear la nueva orden
        $order = new Order();
        $order->user_id = Auth::id(); // Asegúrate de que el usuario está autenticado
        $order->grand_total = $grandTotal;
        $order->payment_status = 'pending'; // Puedes cambiarlo según lo requieras
        $order->status = 'new'; // Puedes cambiarlo según lo requieras
        $order->currency = 'usd'; // Cambia esto según la moneda que estés utilizando
        $order->notes = "Pedido de {$firstName} {$lastName}"; // Puedes añadir notas específicas

        // Guardar la orden en la base de datos
        $order->save();



        // Crear el array de datos a pasar a la vista del PDF
        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone' => $phone,
            'city' => $city,
            'cart_items' => $cartItems,
            'grand_total' => $grandTotal,
            'order_id' => $order->id, // Puedes pasar el ID de la orden al PDF si es necesario
        ];

        // Generar el PDF
        $pdf = PDF::loadView('invoice', $data);

        // Descargar el PDF con un nombre dinámico basado en el nombre del cliente
        return $pdf->download('invoice_' . $firstName . '_' . $lastName . '.pdf');
    }
}


