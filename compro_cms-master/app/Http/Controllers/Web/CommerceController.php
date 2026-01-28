<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductCategory;
use App\Models\ProductVariant;
use Session;
use Toastr;
use DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CommerceController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'E-Commerce';
        $query = Product::where('status', 1);

        // Filter Search
        if($request->has('search') && $request->search != '') {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        // Filter Category
        if($request->has('category') && $request->category != '') {
            $category = ProductCategory::where('slug', $request->category)->first();
            if($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Sorting
        $sort = $request->input('sort', 'newest');
        if($sort == 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif($sort == 'price_high') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $data['products'] = $query->paginate(12);
        $data['categories'] = ProductCategory::all();

        return view('web.ecommerce.index', $data);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('status', 1)->firstOrFail();
        $data['title'] = $product->title;
        $data['product'] = $product;

        // Get related products
        $data['related_products'] = Product::where('status', 1)
                                            ->where('id', '!=', $product->id)
                                            ->take(3)
                                            ->get();

        return view('web.ecommerce.show', $data);
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ? (int)$request->quantity : 1;
        $cart = Session::get('cart', []);

        // Calculate Price with Variants
        $base_price = $product->price;
        $extra_price = 0;
        $selected_variants = [];
        $variant_ids = [];

        if($request->has('variants')) {
            foreach($request->variants as $variant_id) {
                $variant = ProductVariant::find($variant_id);
                if($variant) {
                    $extra_price += $variant->price_extra;
                    $selected_variants[$variant->attribute_name] = $variant->attribute_value;
                    $variant_ids[] = $variant->id;
                }
            }
        }

        $final_price = $base_price + $extra_price;
        
        // Use a unique key for cart item (Product ID + Variants signature)
        $cart_key = $product->id . (count($variant_ids) > 0 ? '_' . implode('_', $variant_ids) : '');

        // Jika action checkout (beli langsung), replace quantity bukan tambahkan
        if($request->input('action') == 'checkout') {
            $cart[$cart_key] = [
                "product_id" => $product->id,
                "title" => $product->title,
                "quantity" => $quantity,
                "price" => $final_price,
                "image_path" => $product->image_path,
                "variants" => $selected_variants,
                "variant_ids" => $variant_ids
            ];
        } else {
            if(isset($cart[$cart_key])) {
                $cart[$cart_key]['quantity'] += $quantity;
            } else {
                $cart[$cart_key] = [
                    "product_id" => $product->id,
                    "title" => $product->title,
                    "quantity" => $quantity,
                    "price" => $final_price,
                    "image_path" => $product->image_path,
                    "variants" => $selected_variants,
                    "variant_ids" => $variant_ids
                ];
            }
        }

        Session::put('cart', $cart);
        
        if($request->input('action') == 'checkout') {
            return redirect()->route('ecommerce.checkout');
        }

        Toastr::success('Produk berhasil ditambahkan ke keranjang!', 'Sukses');
        return redirect()->back();
    }

    public function cart()
    {
        $data['title'] = 'Keranjang Belanja';
        $data['cart'] = Session::get('cart', []);
        
        return view('web.ecommerce.cart', $data);
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = Session::get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            Session::put('cart', $cart);
            
            Toastr::success('Keranjang berhasil diperbarui!', 'Sukses');
        }
        return redirect()->back();
    }

    public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = Session::get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                Session::put('cart', $cart);
            }
            Toastr::success('Produk dihapus dari keranjang!', 'Sukses');
        }
        return redirect()->back();
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);
        if(count($cart) < 1){
            Toastr::error('Keranjang Anda kosong!', 'Error');
            return redirect()->route('ecommerce.index');
        }

        $data['title'] = 'Checkout';
        $data['cart'] = $cart;
        
        return view('web.ecommerce.checkout', $data);
    }

    public function processOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_id_num' => 'required|string|max:255',
            'customer_contact' => 'required|string|max:255',
            'wilayah_kerja' => 'required',
            'unit_kerja_detail_a' => 'required|string',
            'unit_kerja_detail_b' => 'required|string',
            'unit_kerja_detail_c' => 'required|string',
            'user_status' => 'required',
            'payment_mechanism' => 'required',
        ]);
        
        $cart = Session::get('cart', []);
        if(count($cart) < 1){
            Toastr::error('Keranjang kosong, tidak dapat memproses pesanan.', 'Error');
            return redirect()->route('ecommerce.index');
        }

        DB::beginTransaction();
        try {
            $subtotal = 0;
            $shipping_cost = $request->input('shipping_cost', 0);

             // 1. Calculate Subtotal (Stock reduction removed here by request)
             foreach($cart as $item) {
                // We could still check if stock is available to warn user, but not decrement
                $subtotal += $item['price'] * $item['quantity'];
            }

            // Combine Unit Kerja Details into JSON for storage
            $unit_details_combined = json_encode([
                'kab_kota' => $request->unit_kerja_detail_a,
                'cabang' => $request->unit_kerja_detail_b,
                'deputi' => $request->unit_kerja_detail_c
            ]);

            // Create Order
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => $request->customer_name,
                'customer_id_num' => $request->customer_id_num,
                'customer_unit' => "Lengkap (Lihat Detail)", // Simplified string for listing
                'customer_contact' => $request->customer_contact,
                'shipping_address' => $request->shipping_address ?? '-',
                'total_amount' => $subtotal + $shipping_cost,
                'shipping_cost' => $shipping_cost,
                'status' => 'pending',

                // New Fields
                'wilayah_kerja' => $request->wilayah_kerja,
                'unit_kerja_type' => 'complete', // Marking as complete/all filled
                'unit_kerja_detail' => $unit_details_combined,
                'user_status' => $request->user_status,
                'laptop_serial_number' => $request->laptop_serial_number,
                'payment_mechanism' => $request->payment_mechanism,
                'payroll_deduction_periods' => $request->payroll_deduction_periods,
            ]);

            // Create Order Items
            foreach($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'variant_ids' => $item['variant_ids'] ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();

            // Clear Cart
            Session::forget('cart');

            // SYNC TO WOOCOMMERCE
            try {
                $this->postOrderToWooCommerce($order, $cart);
            } catch (\Exception $e) {
                Log::error('WooCommerce Sync Failed: ' . $e->getMessage());
            }

            // Redirect to Document Upload Page
            Toastr::success('Data berhasil disimpan! Silakan unduh dan upload surat pernyataan.', 'Langkah Selanjutnya');
            return redirect()->route('ecommerce.upload_document', ['order_id' => $order->id]);

        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error($e->getMessage(), 'Gagal');
            return redirect()->back()->withInput();
        }
    }

    public function success($order_id)
    {
        $order = Order::with('items.product')->find($order_id);
        
        if(!$order) {
            return redirect()->route('ecommerce.index');
        }

        $data['title'] = 'Pesanan Berhasil';
        $data['order'] = $order;

        return view('web.ecommerce.success', $data);
    }

    public function track(Request $request)
    {
        $data['title'] = 'Cek Status Pesanan';
        
        if($request->has('order_number')) {
            $order = Order::where('order_number', $request->order_number)->first();
            
            if($order) {
                $data['order'] = $order;
            } else {
                Toastr::error('Pesanan tidak ditemukan!', 'Error');
            }
        }

        return view('web.ecommerce.track', $data);
    }

    public function submitReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        \App\Models\ProductReview::create([
            'product_id' => $request->product_id,
            'customer_name' => $request->customer_name,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 1 // Auto-approve
        ]);

        Toastr::success('Terima kasih atas ulasan Anda!', 'Sukses');
        return redirect()->back();
    }

    private function postOrderToWooCommerce($order, $cart)
    {
        $storeUrl = env('WC_STORE_URL');
        $consumerKey = env('WC_CONSUMER_KEY');
        $consumerSecret = env('WC_CONSUMER_SECRET');

        if (!$storeUrl || !$consumerKey || !$consumerSecret) {
            Log::warning('WooCommerce credentials not fully configured in .env');
            return;
        }

        $client = new Client([
            'base_uri' => rtrim($storeUrl, '/') . '/wp-json/wc/v3/',
            'auth' => [$consumerKey, $consumerSecret],
            'verify' => false, // Set to true in production if SSL is valid
        ]);

        $lineItems = [];
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            $wc_product_id = $product ? $product->wc_product_id : null;
            
            // Check if it's a variant
            $wc_variant_id = null;
            if (isset($item['variant_ids']) && !empty($item['variant_ids'])) {
                // In this system, we pick the first variant ID if multiple selected (assuming one variant per product type)
                // Or if it's a specific combination, the variant model should have the wc_variant_id.
                $variant = ProductVariant::find($item['variant_ids'][0]);
                $wc_variant_id = $variant ? $variant->wc_variant_id : null;
            }

            if ($wc_product_id) {
                $li = [
                    'product_id' => (int)$wc_product_id,
                    'quantity' => (int)$item['quantity']
                ];
                if ($wc_variant_id) {
                    $li['variation_id'] = (int)$wc_variant_id;
                }
                $lineItems[] = $li;
            } else {
                Log::info("Product ID {$item['product_id']} has no wc_product_id, skipping from WooCommerce sync.");
            }
        }

        if (empty($lineItems)) {
            Log::info("No WooCommerce-linked products in order {$order->order_number}, skipping sync.");
            return;
        }

        $orderData = [
            'payment_method' => 'cod',
            'payment_method_title' => 'Cash on Delivery',
            'set_paid' => false,
            'billing' => [
                'first_name' => $order->customer_name,
                'address_1' => $order->shipping_address ?? 'CMS Order',
                'phone' => $order->customer_contact,
            ],
            'shipping' => [
                'first_name' => $order->customer_name,
                'address_1' => $order->shipping_address ?? 'CMS Order',
            ],
            'line_items' => $lineItems,
            'customer_note' => "Unit: {$order->customer_unit}, ID: {$order->customer_id_num}",
            'meta_data' => [
                [
                    'key' => '_cms_order_number',
                    'value' => $order->order_number
                ]
            ]
        ];

        $response = $client->post('orders', [
            'json' => $orderData
        ]);

        if ($response->getStatusCode() == 201) {
            $responseData = json_decode($response->getBody(), true);
            Log::info("Order successfully synced to WooCommerce. WC Order ID: " . $responseData['id']);
        } else {
            Log::error("Failed to sync order to WooCommerce. Status: " . $response->getStatusCode());
        }
    }

    public function uploadDocumentPage($order_id)
    {
        $order = Order::findOrFail($order_id);
        // If already passed this step, maybe redirect to success? 
        // For now, allow re-upload if needed or check status.
        
        $data['title'] = 'Upload Surat Pernyataan';
        $data['order'] = $order;
        return view('web.ecommerce.upload_document', $data);
    }

    public function downloadPdf($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('web.ecommerce.pdf_view', compact('order'));
    }

    public function storeDocument(Request $request, $order_id)
    {
        $request->validate([
            'signed_document' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $order = Order::findOrFail($order_id);
        
        if($request->hasFile('signed_document')) {
            $file = $request->file('signed_document');
            $filename = 'signed_' . $order->order_number . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Ensure directory exists
            if(!file_exists(public_path('uploads/documents'))) {
                mkdir(public_path('uploads/documents'), 0777, true);
            }

            $file->move(public_path('uploads/documents'), $filename);

            $order->signed_document_path = $filename;
            $order->save();

            Toastr::success('Dokumen berhasil diupload! Pesanan Anda sedang diproses.', 'Sukses');
            return redirect()->route('ecommerce.success', $order->id);
        }

        Toastr::error('Gagal mengupload dokumen.', 'Error');
        return redirect()->back();
    }
}
