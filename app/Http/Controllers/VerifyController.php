<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function showCheckout()
    {
        // Obtener los elementos del carrito desde la sesión
        $cartItems = session()->get('cart_items', []);
        $grandTotal = session()->get('grand_total', 0);
        
        // Calcular el subtotal sumando los precios de los elementos en el carrito
        $subtotal = array_sum(array_column($cartItems, 'price'));

        // Pasar los datos a la vista
        return view('checkout-page', compact('cartItems', 'subtotal', 'grandTotal'));
    }

    public function generatePDF(Request $request)
    {
        // Datos del pedido
        $data = [
            'customer_name' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'subtotal' => $request->input('subtotal'),
            'grand_total' => $request->input('grand_total'),
            'item' => $request->input('item'),
            'item_count' => $request->input('item_count'),
        ];

        // Generar el PDF utilizando la vista 'invoice'
        $pdf = Pdf::loadView('invoice', $data);

        return $pdf->download('comprobante_venta.pdf');
    }
}
