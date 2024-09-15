<?php

namespace App\Livewire\Guest\Pages;

use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Checkout extends Component
{
    use LivewireAlert;

    public $user = null;
    public $first_name;
    public $last_name;
    public $email;
    public $telephone;
    public $description;

    public $cart;
    public $sub_total = 0;
    public $service_fee = 0;
    public $total = 0;

    public $paymode = 'cashondelivery';

    protected $listeners = [
        'placeOrder'
    ];

    public function mount()
    {
        if (!auth()->guard('guest')->check()) {
            return redirect()->route('login');
        }

        // check if cart is empty
        if (\Cart::isEmpty()) {
            return redirect()->route('home.page');
        }

        $this->user = auth()->guard('guest')->user();
        $this->first_name = $this->user?->first_name;
        $this->last_name = $this->user?->last_name;
        $this->email = $this->user?->email;
        $this->telephone = $this->user?->telephone;

        $this->cart = \Cart::getContent();

        $this->sub_total = $this->cart->reduce(function ($carry, $item) {
            return $carry + $item->price * $item->quantity;
        });
        $this->service_fee = 1;
        $this->total = $this->sub_total + $this->service_fee;
    }

    public function render()
    {
        return view('livewire.guest.pages.checkout')->extends('livewire.guest.layouts.master');
    }

    public function updateProfile()
    {
        User::where('id', $this->user->id)->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            // 'email' => $this->email,
            'telephone' => $this->telephone
        ]);

        $this->mount();

        $this->alert('success', 'Profile updated successfully');
    }

    public function confirmOrderPlaced()
    {
        $this->alert('question', 'Are you sure you want to place this order?', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'cancelButtonText' => 'No',
            'showCancelButton' => true,
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'placeOrder',
            'onCancelled' => 'cancelled',
        ]);
    }

    public function placeOrder()
    {
        $validator = Validator::make($this->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'required',
        ]);

        if ($validator->fails()) {
            $this->alert('error', $validator->errors()->first());
            return;
        }

        if (\Cart::isEmpty()) {
            return redirect()->route('home.page');
        }

        try {
            DB::beginTransaction();

            if ($this->paymode == 'cashondelivery') {
                // complete the cart item to order and orderitems table
                $order = new Order();
                $order->user_id = $this->user->id;
                $order->total_amount = 0; // We'll calculate this later
                $order->status = 'pending';
                $order->save();

                foreach ($this->cart as $item) {
                    $order->order_items()->create([
                        'product_id' => $item['attributes']['product']->id,
                        'product_variant_id' => null,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'status' => 'pending',
                    ]);

                    $order->total_amount += $item['price'] * $item['quantity'];
                    $order->save();
                }

                // dd($order);
                OrderHistory::create([
                    'order_id' => $order->id,
                    'description' => $this->description ?? 'Order placed successfully',
                ]);

                \Cart::clear();

                $this->flash('success', 'Order placed successfully', [
                    'position' => 'center',
                    'toast' => false,
                    'timer' => 6000,
                    'text' => 'Order placed successfully. Thank you for shopping with us.',
                    'timerProgressBar' => true,
                    'showConfirmButton' => true,
                    'allowOutsideClick' => false
                ], route('shop.page'));

                // return redirect(route('shop.page'));
            }

            if ($this->paymode == 'mobilemoneygh') {
                // not done
                $this->alert('warning', 'Not yet implemented');
                return;
            }

            $this->alert('info', 'Processing payment...');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            $this->alert('error', $th->getMessage());
        }
    }
}
