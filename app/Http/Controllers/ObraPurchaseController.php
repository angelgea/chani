<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Style;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ObraPurchaseController extends Controller
{

    private const STRIPE_IN_CENTS = 100;

    public function purchase($id)
    {

        // TOOD: Validation
        // exists:obra,id

        //dd(auth()->user()->newSubscription('cashier', request()->plan)->create(request()->paymentMethod));

        // Hacer el pago
        $success = true;

        $user = User::findOrFail(request()->user_id);
        $obra = Obra::findOrFail($id);

        try {
            $payment = $user->charge(
                $obra->price * self::STRIPE_IN_CENTS,
                request()->input('payment_method_id')
            );

            //$payment = $payment->asStripePaymentIntent();

            $obra = Obra::find($id);
            $obra->status_id = Status::SOLD;
            $obra->save();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
        // Guardar datos a bbdd, 
        // obra_user table
        // quien ha comprado => user_id, 
        // el que => obra_id, 
        // cuando ha hecho la compra 

        if ($success) {
            DB::table('obra_user')
                ->insert([
                    'obra_id'  => $id,
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }

        return response()->json([
            'status' => 'Compra realizada con éxito, muchas gracias!'
        ], 200);
    }

    public function history()
    {
        $styles = Style::all(['id', 'name']);

        $purchasedObras = auth()->user()->purchasedObras;

        return view('obras.obra_purchase_history', [
            'purchasedObras' => $purchasedObras,
            'styles' => $styles,
        ]);
    }
}
