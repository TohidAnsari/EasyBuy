<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\Transaction;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Stripe\Stripe;

class CheckoutComponent extends Component
{
    //Billing Adderess
    public $first_name;
    public $last_name;
    public $email;
    public $mobile;
    public $address1;
    public $address2;
    public $country;
    public $city;
    public $state;
    public $zip_code;
    public $is_shipping_different;
    //Shipping Adderess
    public $first_name_2;
    public $last_name_2;
    public $email_2;
    public $mobile_2;
    public $address1_2;
    public $address2_2;
    public $country_2;
    public $city_2;
    public $state_2;
    public $zip_code_2;

    public $paymentmode;
    public $thankyou;
    public $paymentForm1;
    public $paymentForm2;
    public $paymentForm3;

    public $card_no;
    public $exp_month;
    public $exp_year;
    public $cvc;




    function paymentForm1(){
        $this->paymentForm1 = true;
        $this->paymentForm2 = false;
        $this->paymentForm3 = false;
    }
    function paymentForm2(){
        $this->paymentForm1 = false;
        $this->paymentForm2 = true;
        $this->paymentForm3 = false;
    }
    function paymentForm3(){
        $this->paymentForm1 = false;
        $this->paymentForm2 = false;
        $this->paymentForm3 = true;
    }


    function update($fields)
    {
        $this->validateOnly($fields, [
            'first_name'        => 'required',
            'last_name'         => 'required',
            'email'             => 'required | email',
            'mobile'            => 'required|numeric',
            'address1'          => 'required',
            'city'              => 'required',
            'state'             => 'required',
            'zip_code'          => 'required'
        ]);

        if($this->is_shipping_different){
            $this->validateOnly($fields, [
                'first_name_2' => 'required',
                'last_name_2'  => 'required',
                'email_2'      => 'required|email',
                'mobile_2'     => 'required|numeric',
                'address1_2'   => 'required',
                'city_2'       => 'required',
                'state_2'      => 'required',
                'zip_code_2'   => 'required',
                'paymentmode'  => 'required'
            ]);
        }
        if($this->paymentmode == 'paypal'){
            $this->validateOnly($fields, [
                'card_no'       => 'required | numeric',
                'expmonth'      => 'required | numeric',
                'exp_year'      => 'required|numeric',
                'cvc'           => 'required',
            ]);
        }
    }

    public function placeOrder(){
        // dd($this->is_shipping_different);
        // dd($this->paymentmode,session()->get('checkout')['subTotal']);

       $this->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required | email',
            'mobile'        => 'required|numeric',
            'address1'      => 'required',
            'city'          => 'required',
            'state'         => 'required',
            'zip_code'      => 'required'
        ]);
        if($this->paymentmode == 'paypal'){
            $this->validate([
                'card_no'       => 'required | numeric',
                'exp_month'     => 'required | numeric',
                'exp_year'      => 'required | numeric',
                'cvc'           => 'required',
            ]);
        }
        // dd($this->card_no);
        $order = new Order();
        $order->user_id     = Auth::user()->id;
        $order->subtotal    = str_replace(',', '', session()->get('checkout')['subTotal']);
        $order->total       = str_replace(',', '', session()->get('checkout')['total']);
        $order->discount    = str_replace(',', '', session()->get('checkout')['discount']);
        $order->tax         = str_replace(',', '', session()->get('checkout')['tax']);
        // dd($order->subtotal, $order->total, $order->discount, $order->tax);
        $order->first_name  =  $this->first_name;
        $order->last_name   =  $this->last_name;
        $order->email       =  $this->email;
        $order->mobile      =  $this->mobile;
        $order->line1       =  $this->address1;
        $order->line2       =  $this->address2;
        $order->country     =  $this->country;
        $order->city        =  $this->city;
        $order->province    =  $this->state;
        $order->zip_code    =  $this->zip_code;
        $order->status      =  'ordered';
        $order->is_shipping_different    =  $this->is_shipping_different ? 1:0;
        $order->save();


        foreach(Cart::instance('addtocart')->content() as $item){
            $orederItem = new OrderItem();
            $orederItem->product_id = $item->id;
            $orederItem->order_id   = $order->id;
            $orederItem->price      = $item->price;
            $orederItem->quantity   = $item->qty;
            $orederItem->save();
        }
        if ($this->is_shipping_different) {
            $this->validate([
                'first_name_2' => 'required',
                'last_name_2'  => 'required',
                'email_2'      => 'required | email',
                'mobile_2'     => 'required|numeric',
                'address1_2'   => 'required',
                'city_2'       => 'required',
                'state_2'      => 'required',
                'zip_code_2'   => 'required',
                'paymentmode'  => 'required'
            ]);
            // dd($this->is_shipping_different);
            $shipping = new Shipping();
            $shipping->order_id    =  $order->id;
            $shipping->first_name  =  $this->first_name_2;
            $shipping->last_name   =  $this->last_name_2;
            $shipping->email       =  $this->email_2;
            $shipping->mobile      =  $this->mobile_2;
            $shipping->line1    =  $this->address1_2;
            $shipping->line2    =  $this->address2_2;
            $shipping->country     =  $this->country_2;
            $shipping->city        =  $this->city_2;
            $shipping->	province       =  $this->state_2;
            $shipping->zip_code    =  $this->zip_code_2;
            $shipping->save();
        }

        if($this->paymentmode == 'cod'){
            $this->makeTransaction($order->id, 'pending');
            $this->resetCart();
        }
        else if($this->paymentmode == 'card'){
            $stripe = Stripe::make('sk_test_51LXKYrSEwsvJviKenHwmv5OI4hc0ZS2MuumFQKQ7JsI82bVAovtu0Aysga8ryKt7Ifz8SGNgteXs7A8vkAOZU2Y500ZoOcmLFa');
            try{
                $token = $stripe->tokens()->create([
                    'card'=>[
                        'number'        => $this->card_no,
                        'exp_month'     => $this->exp_month,
                        'exp_year'      => $this->exp_year,
                        'cvc'           => $this->cvc
                    ]
                ]);
                if(!isset($token['id'])){
                    session()->flash('stripe_error', 'The Stripe Token Was Not Generated Properly..!');
                    $this->thankyou = 0;
                }
                $customer = $stripe->customers()->create([
                    'name' => $this->first_name. ' '. $this->last_name,
                    'email'=> $this->email,
                    'phone'=>$this->mobile,
                    'address'=> [
                        'line1'=>$this->address1,
                        'postal_code' => $this->zip_code,
                        'city'=>$this->city,
                        'state' => $this->state,
                        'country'=>$this->country
                    ],
                    'shipping' => [
                        'name' => $this->first_name. ' '. $this->last_name,
                        'address'=> [
                            'line1'=>$this->address1,
                            'postal_code' => $this->zip_code,
                            'city'=>$this->city,
                            'state' => $this->state,
                            'country'=>$this->country
                        ],
                    ],
                        'source' => $token['id']
                ]);
                $charge = $stripe->charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'USD',
                    'amount' =>   session()->get('checkout')['total'],
                    'description' => 'Payment For Order No '. $order->id
                ]);
                if($charge['status'] == 'succeeded'){
                    $this->makeTransaction($order->id, 'approved');
                    $this->resetCart();
                }
                else{
                    session()->flash('stripe_error', 'An Error Accured In While Transaction..!');
                    $this->thankyou = 0;
                }
            } catch(Exception $e){
                session()->flash('stripe_error', $e->getMessage());
                $this->thankyou = 0;
            }
        }
        else if($this->paymentmode == 'net_banking'){

        }

    }

    public function resetCart(){
        $this->thankyou = 1;
        Cart::instance('addtocart')->destroy();
        session()->forget('checkout');
    }

    public function makeTransaction($order_id, $status){
        $transaction            = new Transaction();
        $transaction->user_id   = Auth::user()->id;
        $transaction->order_id  = $order_id;
        $transaction->mode      = 'cod';
        $transaction->status    = $status;
        $transaction->save();
    }
    public function verifyUser(){
        if(!Auth::check()){
            return redirect()->route('login');
        }
        else if($this->thankyou){
            return redirect()->route('thank-you');
        }
        else if(!session()->get('checkout')){
            return redirect()->route('product.cart');
        }
    }

    public function render()
    {
        //echo "hiiiiiiiii";
       $this->verifyUser();
        return view('livewire.checkout-component')->layout('layouts.base');
    }
}
