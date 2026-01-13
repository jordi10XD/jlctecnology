<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importante para la transacción
use Barryvdh\DomPDF\Facade\Pdf;
class OrderController extends Controller
{
    public function index()
    {
        // Cargamos las ordenes CON sus items (Eager Loading)
        $orders = Order::with('items')->orderBy('created_at', 'desc')->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        // 1. Validación
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'customer_email' => 'nullable|email',
            'total' => 'required|numeric',
            'items' => 'required|array', // El array de productos del carrito
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.price' => 'required|numeric',
            'items.*.name' => 'required|string',
        ]);

        try {
            // 2. Transacción: Todo o nada
            $order = DB::transaction(function () use ($validated) {
                // A. Crear la cabecera de la orden
                $order = Order::create([
                    'customer_name' => $validated['customer_name'],
                    'customer_phone' => $validated['customer_phone'],
                    'customer_email' => $validated['customer_email'] ?? null,
                    'total' => $validated['total'],
                    'status' => 'PENDING', // Estado inicial
                    'user_id' => auth('sanctum')->id(),
                ]);

                // B. Crear los items
                foreach ($validated['items'] as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'product_name' => $item['name'],
                        'price' => $item['price'],
                    ]);
                }

                return $order;
            });

            // 3. Devolver la orden con sus items cargados
            return response()->json($order->load('items'), 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la orden: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        // Vital para el PDF: Buscar orden CON items
        $order = Order::with('items')->find($id);

        if (!$order) {
            return response()->json(['message' => 'Orden no encontrada'], 404);
        }

        return response()->json($order);
    }

    /**
     * Generar y descargar el PDF de la factura/proforma.
     */
    public function downloadInvoice($id)
    {
        // 1. Buscamos la orden con sus productos (items)
        // Si no usas 'with', la vista fallará al intentar leer los productos
        $order = Order::with('items')->findOrFail($id);

        // 2. Definimos datos extra para el PDF (Opcional: logo en base64 si tienes problemas de rutas)
        $data = [
            'order' => $order,
            'title' => 'Comprobante de Pedido #' . $order->id,
            'date' => $order->created_at->format('d/m/Y')
        ];

        // 3. Cargamos la vista 'pdf.invoice' (que creamos en el paso anterior)
        $pdf = Pdf::loadView('pdf.invoice', $data);

        // 4. Opción A: Descargar directamente
        // return $pdf->download('factura-jlc-'.$order->id.'.pdf');

        // 4. Opción B: Ver en el navegador (Recomendado para probar)
        return $pdf->stream('proforma-jlc-'.$order->id.'.pdf');
    }
}