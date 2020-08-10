<?php

namespace App\Http\Controllers;


use App\Order; 
use Illuminate\Http\Request;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //

    protected $order;

    public function __construct( Order $order )
    {
        $this->order = $order;
    }

    public function index()
    {
        //orders = Order::latest()->get();

        /*$orders = $this->order->OrderBy('id','DESC')->paginate(5);
        
        return view('orders.index',[
            'orders'=> $orders
        ]);*/
        return 'no disponible';
    }
    public function admin()
    {
        //orders = Order::latest()->get();

        $orders = $this->order->OrderBy('id','DESC')->paginate(5);
        
        return view('orders.index',[
            'orders'=> $orders
        ]);
        
    }
    public function view($id)
    {
        $order  = Order::find($id);
        
        if(!$order)
        {
            return "No se encontró";
        }
        else
        {
            return view('orders.view',[
                'order'=> $order
            ]);   
        }
    }
    public function search()
    {
        return view('orders.search');
    }
    public function searchView(Request $request)
    {
        //dd($request);
        $request->validate([
            'customer_document_type'     => 'required',
            'customer_document'         => 'required',
            'customer_email'            => ['required','email']
         ]);
        
        $orders = $this->order->where('customer_document',$request->customer_document)
        ->where('customer_email',$request->customer_email)->paginate(5);        
                        
        //dd($orders);
        return view('orders.index',[
            'orders'=> $orders
        ]);   
    }
    
    public function buy($id)
    {  

        $products = array(
            '1' => array(
                'id'=>'1',
                'title'=>'Camiseta Negra',
                'description'=>'Camiseta Negra para hombre estampado adelante',
                'amount'=>'39900'
            ),
            '2' => array(
                'id'=>'2',
                'title'=>'Camiseta Azul',
                'description'=>'Camiseta Azul para hombre estampado adelante',
                'amount'=>'34900'
            )
        );
        //var_dump($products);
        //if (in_array($id, $products)) {
        
        if(array_search($id, array_column($products, 'id')) !== false) {
              
            return view('orders.buy',[
                'product'=>$products[$id]
                ]);
            }
        else{
            return "No se encontró el producto";
        }
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'customer_name'             => 'required',
            'customer_last_name'         =>'required',      
            'customer_document_type'     => 'required',
            'customer_document'         => 'required',

            'customer_country'           => 'required',
            'customer_province'           => 'required',
            'customer_city'           => 'required',

            'customer_street'           => 'required',
            'customer_postal_code'       => 'required',
            'customer_phone'            => ['required','min:7'],
            'customer_mobile'           => ['required','min:7'],
            'customer_email'            => ['required','email']
        ]);
        
        $name = "$request->customer_name $request->customer_last_name";

        $order = Order::create([
            'description'               =>  $request->description,
            'customer_name'             =>  $name,      
            'customer_document'         =>  $request->customer_document,
            'customer_document_type'    =>  $request->customer_document_type,
            
            'customer_country'          => $request->customer_country,
            'customer_province'         => $request->customer_province,
            'customer_city'             => $request->customer_city,
           

            'customer_street'           => $request->customer_street,
            'customer_postal_code'       => $request->customer_postal_code,
            'customer_phone'            => $request->customer_phone,
            'customer_mobile'           => $request->customer_mobile,
            'customer_email'            => $request->customer_email,

            'status'=> 'CREATED',
            'created_at'=>now(),
            'updated_at'=>null,
            'amount'=> $request->amount,
            'request_id_placetopay'=>0
        ]);

        // Aquí Notificar vía email al admin de la tienda sobre la nueva orden 
        //        
        return redirect()->route('orders.view', ['id' => $order->id])->with('status','Orden creada correctamente');
    }

    public function payment($id)
    {
        $order  = Order::find($id);
        
        if(!$order)
        {
            return "No se encontró";
        }
        else
        {
            
            $placetopay = new PlacetoPay(array_merge([
                'login' => env('PLACETOPAY_LOGIN'),
                'tranKey' => env('PLACETOPAY_TRANKEY'),
                'url' => env('PLACETOPAY_URL'),
            ]));

            $reference = "ABC".$order->id;
            $name = (explode(" ",$order->customer_name));

            // Request Information
            $request = [
                'locale' => 'es_CO',
                'payer' => [
                    'name' => $name[0],
                    'surname' => $name[1],
                    'email' => $order->customer_email,
                    'documentType' => $order->customer_document_type,
                    'document' => $order->customer_document,
                    'mobile' => $order->customer_mobile,
                    'address' => [
                        'street' => $order->customer_street,
                        'city' => $order->customer_city,
                        'state' => $order->customer_province,
                        'postalCode' => $order->customer_postal_code,
                        'country' => $order->customer_country,
                        'phone' => $order->customer_phone,
                    ],
                ],
                'buyer' => [
                    'name' => $name[0],
                    'surname' => $name[1],
                    'email' => $order->customer_email,
                    'documentType' => $order->customer_document_type,
                    'document' => $order->customer_document,
                    'mobile' => $order->customer_mobile,
                    'address' => [
                        'street' => $order->customer_street,
                        'city' => $order->customer_city,
                        'state' => $order->customer_province,
                        'postalCode' => $order->customer_postal_code,
                        'country' => $order->customer_country,
                        'phone' => $order->customer_phone,
                    ],
                ],
                'payment' => [
                    'reference' => $reference,
                    'description' => $order->description,
                    'amount' => [
                        'currency' => 'COP',
                        'total' => $order->amount,
                    ],
                    'items' => [
                        [
                            'sku' => 1,
                            'name' => $order->description,
                            'category' => 't-shirts',
                            'qty' => 1,
                            'price' => $order->amount,
                            'tax' => 0,
                        ],
                    ],
                    'shipping' => [
                        'name' => $name[0],
                        'surname' => $name[1],
                        'email' => $order->customer_email,
                        'documentType' => $order->customer_document_type,
                        'document' => $order->customer_document,
                        'mobile' => $order->customer_mobile,
                        'address' => [
                            'street' => $order->customer_street,
                            'city' => $order->customer_city,
                            'state' => $order->customer_province,
                            'postalCode' => $order->customer_postal_code,
                            'country' => $order->customer_country,
                            'phone' => $order->customer_phone,
                        ],
                    ],
                    'allowPartial' => false,
                ],
                'expiration' => date('c', strtotime('+1 hour')),
                'ipAddress' => '127.0.0.1',
                'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36',
                'returnUrl' => "http://localhost/testplacetopay/public/orders/payment/check-status/{$order->id}",
                'cancelUrl' => "http://localhost/testplacetopay/public/orders/payment/check-status/{$order->id}",
                'skipResult' => false,
                'noBuyerFill' => false,
                'captureAddress' => false,
                'paymentMethod' => null,
            ];

            try {
                $response = $placetopay->request($request);

                if ($response->isSuccessful()) {
                    // Redirect the client to the processUrl or display it on the JS extension
                    // Actualizar orden y redirigir... 
                    $updated = DB::table('orders')
                                    ->where('id',  $order->id)
                                    ->update(['request_id_placetopay' => $response->requestId()]);

                   return redirect()->away($response->processUrl());
                } else {
                    // There was some error so check the message
                    // $response->status()->message();
                    var_dump($response);
                }
                
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
    public function checkPayment($id)
    {
        $order  = Order::find($id);
        
        if(!$order)
        {
            return "No se encontró la orden";
        }
        else
        {
            $placetopay = new PlacetoPay(array_merge([
                'login' => env('PLACETOPAY_LOGIN'),
                'tranKey' => env('PLACETOPAY_TRANKEY'),
                'url' => env('PLACETOPAY_URL'),
            ]));

            $response = $placetopay->query($order->request_id_placetopay);

            if ($response->isSuccessful()) {
                if ($response->status()->isApproved())
                {
                    // Actualizar pago... 
                    $updated = DB::table('orders')
                                    ->where('id',  $order->id)
                                    ->update(['status' => 'PAYED','updated_at'=>now()]);

                    // Aquí notificar al admin y al user sobre el pago. 
                    
                    return redirect()->route('orders.view', ['id' => $order->id]);

                }elseif ($response->status()->isRejected())
                {
                    // Actualizar pago... 
                    $updated = DB::table('orders')
                                    ->where('id',  $order->id)
                                    ->update(['status' => 'REJECTED','updated_at'=>now()]);
                    // Aquí notificar al admin y al user sobre el pago. 


                    return redirect()->route('orders.view', ['id' => $order->id]);    
                }
                elseif($response->status()->status()=='PENDING')
                {
                    // Actualizar pago... 
                    $updated = DB::table('orders')
                    ->where('id',  $order->id)
                    ->update(['status' => 'PENDING','updated_at'=>now()]);
                        // Aquí notificar al admin y al user sobre el pago. 

                    return redirect()->route('orders.view', ['id' => $order->id]);    
                }
                else
                {
                    print_r($response->status()->message() . "\n");
                }
            } else {
                // There was some error with the connection so check the message
                print_r($response->status()->message() . "\n");
            }
        }
    }
}
