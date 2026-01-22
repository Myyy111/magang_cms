<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Session;
use Toastr;
use DB;

class CommerceController extends Controller
{
    public function index()
    {
        $data['title'] = 'E-Commerce';
        $data['products'] = Product::where('status', 1)->orderBy('created_at', 'desc')->paginate(9);

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

        // Jika action checkout (beli langsung), replace quantity bukan tambahkan
        if($request->input('action') == 'checkout') {
            $cart[$request->product_id] = [
                "product_id" => $product->id,
                "title" => $product->title,
                "quantity" => $quantity,
                "price" => $product->price,
                "image_path" => $product->image_path
            ];
        } else {
            // Jika action add to cart, tambahkan quantity jika sudah ada
            if(isset($cart[$request->product_id])) {
                $cart[$request->product_id]['quantity'] += $quantity;
            } else {
                $cart[$request->product_id] = [
                    "product_id" => $product->id,
                    "title" => $product->title,
                    "quantity" => $quantity,
                    "price" => $product->price,
                    "image_path" => $product->image_path
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
            'customer_unit' => 'required|string|max:255',
            'customer_contact' => 'required|string|max:255',
        ]);

        $cart = Session::get('cart', []);
        if(count($cart) < 1){
            Toastr::error('Keranjang kosong, tidak dapat memproses pesanan.', 'Error');
            return redirect()->route('ecommerce.index');
        }

        DB::beginTransaction();
        try {
            $total_amount = 0;
            foreach($cart as $item) {
                $total_amount += $item['price'] * $item['quantity'];
            }

            // Create Order
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => $request->customer_name,
                'customer_id_num' => $request->customer_id_num,
                'customer_unit' => $request->customer_unit,
                'customer_contact' => $request->customer_contact,
                'shipping_address' => $request->shipping_address,
                'total_amount' => $total_amount,
                'status' => 'pending',
            ]);

            // Create Order Items
            foreach($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();

            // Clear Cart
            Session::forget('cart');

            // Redirect to Success Page
            Toastr::success('Pesanan berhasil dibuat!', 'Sukses');
            return redirect()->route('ecommerce.success', ['order_id' => $order->id]);

        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage(), 'Error');
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
}
