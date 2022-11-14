<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Traits\ResponseTraits;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    use ResponseTraits;

    public function order(Request $request)
    {
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'price' => $request->total,
                'order_status' => 0,
            ]);
            $color = $request->flevour;
            foreach ($color as $value) {
                Item::create([
                    'order_id' => $order['id'],
                    'name' => $value['name'],
                    'price' => $value['price']
                ]);
            }
            return response()->json(['status' => true, 'message' => 'success']);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }

    public function orderItem()
    {
        try {
            $item = Order::where('user_id', Auth::id())->orderby('id', 'desc')->with('item')->paginate(5);
            return response()->json($item);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }

    public function allOrder()
    {
        try {
            // Cache::forget('order');
            $item = Cache::get('order');
            return Benchmark::dd(fn () => $item);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }

    public function orderDelete($id)
    {
        try {
            Order::find($id)->delete();
            return response()->json(['message'=>'Delete succesful']);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }
}
