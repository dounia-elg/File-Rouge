<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class PaymentController extends Controller
{
    public function __construct()
    {

        if (config('services.stripe.secret')) {
            Stripe::setApiKey(config('services.stripe.secret'));
        } else {
            Log::error('Stripe API key is not set in config');
        }
    }

    public function checkout(Artwork $artwork)
    {

        if ($artwork->is_sold) {
            return redirect()->back()->with('error', 'This artwork has already been sold.');
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to purchase artwork.');
        }

        try {
            Log::info('Creating Stripe checkout session', ['artwork_id' => $artwork->id, 'user_id' => Auth::id()]);

            $successUrl = route('payment.success', ['artwork' => $artwork->id]) . '?session_id={CHECKOUT_SESSION_ID}';
            $cancelUrl = route('payment.cancel', ['artwork' => $artwork->id]);

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $artwork->title,
                            'description' => $artwork->description ?? 'Artwork purchase',
                            'images' => [$artwork->image_path ? asset('storage/' . $artwork->image_path) : null],
                        ],
                        'unit_amount' => (int)($artwork->price * 100),
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
                'client_reference_id' => $artwork->id,
                'customer_email' => Auth::user()->email,
                'metadata' => [
                    'artwork_id' => $artwork->id,
                    'user_id' => Auth::id(),
                ],
            ]);

            Log::info('Stripe session created successfully', ['session_id' => $session->id]);

            return redirect($session->url);
        } catch (ApiErrorException $e) {
            Log::error('Stripe API Error: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'artwork_id' => $artwork->id,
                'user_id' => Auth::id()
            ]);
            return redirect()->back()->with('error', 'Payment service error: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Payment processing failed: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'artwork_id' => $artwork->id
            ]);
            return redirect()->back()->with('error', 'Payment processing failed. Please try again.');
        }
    }

    public function success(Request $request, Artwork $artwork)
    {
        Log::info('Payment success callback received', [
            'artwork_id' => $artwork->id,
            'request' => $request->all(),
            'session_id' => $request->get('session_id')
        ]);

        
        if (!$request->has('session_id')) {
            Log::error('Session ID missing in success callback');
            return redirect()->route('artworks.show', $artwork)
                ->with('error', 'Payment verification failed: Missing session ID.');
        }

        try {
            $sessionId = $request->get('session_id');
            $session = Session::retrieve($sessionId);

            Log::info('Stripe session retrieved', [
                'session' => [
                    'id' => $session->id,
                    'payment_status' => $session->payment_status,
                    'amount_total' => $session->amount_total,
                ]
            ]);

            if ($session->payment_status === 'paid') {
                // Create payment record
                $payment = Payment::create([
                    'user_id' => Auth::id(),
                    'artwork_id' => $artwork->id,
                    'stripe_payment_id' => $session->payment_intent,
                    'amount' => $artwork->price,
                    'currency' => 'usd',
                    'status' => 'completed',
                    'payment_details' => json_encode($session->toArray()),
                ]);

                Log::info('Payment record created', ['payment_id' => $payment->id]);

                // Mark artwork as sold
                $artwork->update(['is_sold' => true]);
                Log::info('Artwork marked as sold', ['artwork_id' => $artwork->id]);

                return redirect()->route('artworks.show', $artwork)
                    ->with('success', 'Payment successful! Thank you for your purchase.');
            } else {
                Log::warning('Payment not marked as paid', ['payment_status' => $session->payment_status]);
                return redirect()->route('artworks.show', $artwork)
                    ->with('error', 'Payment not confirmed. Please contact support.');
            }
        } catch (ApiErrorException $e) {
            Log::error('Stripe API Error in success callback: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'artwork_id' => $artwork->id,
                'session_id' => $request->get('session_id')
            ]);
            return redirect()->route('artworks.show', $artwork)
                ->with('error', 'Payment verification failed. Please contact support.');
        } catch (\Exception $e) {
            Log::error('Error in payment success handler: ' . $e->getMessage(), [
                'exception' => $e,
                'artwork_id' => $artwork->id,
                'session_id' => $request->get('session_id')
            ]);
            return redirect()->route('artworks.show', $artwork)
                ->with('error', 'There was an error processing your payment. Please contact support.');
        }
    }

    public function cancel(Artwork $artwork)
    {
        Log::info('Payment cancelled', ['artwork_id' => $artwork->id]);
        return redirect()->route('artworks.show', $artwork)
            ->with('error', 'Payment was cancelled.');
    }
}
