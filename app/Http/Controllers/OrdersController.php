<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Placetopay\Placetopay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    public function index()
    {
        return view('orders', [
            'orders' => Order::get()
        ]);
    }
    public function show($id)
    {
        return view('order', [
            'order' => Order::find($id)
        ]);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $order = $this->saveOrder($input);
        $placetopay=(new Placetopay())->request($order);
        if ($placetopay->isSuccessful()) {
            $order->setAttribute('request_id', $placetopay->requestId());
            $order->save();
            return response()->json([
                "error" => false,
                "url" => $placetopay->processUrl()
            ]);
        }else {
            return response()->json([
                "error" => true,
                "mensaje" => $placetopay->status()->message()
            ]);
        }
    }

    public function pay($order_id)
    {
        $order = Order::find($order_id);
        $placetopay=(new Placetopay())->request($order);
        if ($placetopay->isSuccessful()) {
            $order->setAttribute('request_id', $placetopay->requestId());
            $order->save();
            return response()->json([
                "error" => false,
                "url" => $placetopay->processUrl()
            ]);
        }else {
            return response()->json([
                "error" => true,
                "mensaje" => $placetopay->status()->message()
            ]);
        }
    }

    public function placetopayRequest($order)
    {
        $placetopay =(new Placetopay())->requestId($order);
        if ($placetopay->isSuccessful()) {
            if ($placetopay->status()->isApproved()) {
                $order->setAttribute('status', 'PAYED');
                $order->save();
            }
            if ($placetopay->status()->isRejected()) {
                $order->setAttribute('status', 'REJECTED');
                $order->save();
            }
        }
        return $placetopay;
    }

    public function orderPay($order_id)
    {
        $order = Order::find($order_id);
        sleep(10);
        $placetopay = $this->placetopayRequest($order);
        return view('order', [
            'order' => $order,
            'status' => $order->getAttribute('status')
        ]);
    }

    private function saveOrder(array $input):Order
    {
        try {
            DB::beginTransaction();
            $order = new Order();
            $order->setAttribute('customer_name',$input['name']);
            $order->setAttribute('customer_email',$input['email']);
            $order->setAttribute('customer_mobile',$input['mobile']);
            $order->setAttribute('total',$input['value']);
            $order->setAttribute('status','CREATED');
            $order->setAttribute('request_id','0');
            $order->saveOrFail();

            $detail = new OrderDetail();
            $detail->setAttribute('product_id',$input['productId']);
            $detail->setAttribute('order_id',$order->getKey());
            $detail->setAttribute('amount', 1);
            $detail->setAttribute('value', $input['value']);
            $detail->saveOrFail();
            DB::commit();
            return $order;
        } catch (Throwable $e) {
            DB::rollback();
            Log::error($e);
            throw $e;
        }
    }
}
