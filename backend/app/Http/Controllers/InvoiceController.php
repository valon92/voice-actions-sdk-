<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * List invoices for platform
     */
    public function list(Request $request)
    {
        $apiKey = $request->bearerToken() ?? $request->header('X-API-Key');
        $platform = $this->verifyApiKey($apiKey);
        
        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid API key'
            ], 401);
        }

        $invoices = DB::table('invoices')
            ->where('platform_id', $platform['id'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'invoices' => $invoices->map(function ($invoice) {
                return [
                    'id' => $invoice->id,
                    'amount' => $invoice->amount / 100, // Convert from cents
                    'currency' => strtoupper($invoice->currency),
                    'status' => $invoice->status,
                    'invoice_pdf_url' => $invoice->invoice_pdf_url,
                    'invoice_hosted_url' => $invoice->invoice_hosted_url,
                    'period_start' => $invoice->period_start,
                    'period_end' => $invoice->period_end,
                    'paid_at' => $invoice->paid_at,
                    'created_at' => $invoice->created_at,
                ];
            })
        ]);
    }

    /**
     * Get invoice details
     */
    public function get(Request $request, $id)
    {
        $apiKey = $request->bearerToken() ?? $request->header('X-API-Key');
        $platform = $this->verifyApiKey($apiKey);
        
        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid API key'
            ], 401);
        }

        $invoice = DB::table('invoices')
            ->where('id', $id)
            ->where('platform_id', $platform['id'])
            ->first();

        if (!$invoice) {
            return response()->json([
                'success' => false,
                'error' => 'Invoice not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'invoice' => [
                'id' => $invoice->id,
                'amount' => $invoice->amount / 100,
                'currency' => strtoupper($invoice->currency),
                'status' => $invoice->status,
                'invoice_pdf_url' => $invoice->invoice_pdf_url,
                'invoice_hosted_url' => $invoice->invoice_hosted_url,
                'period_start' => $invoice->period_start,
                'period_end' => $invoice->period_end,
                'paid_at' => $invoice->paid_at,
                'created_at' => $invoice->created_at,
            ]
        ]);
    }

    /**
     * Download invoice PDF
     */
    public function download(Request $request, $id)
    {
        $apiKey = $request->bearerToken() ?? $request->header('X-API-Key');
        $platform = $this->verifyApiKey($apiKey);
        
        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid API key'
            ], 401);
        }

        $invoice = DB::table('invoices')
            ->where('id', $id)
            ->where('platform_id', $platform['id'])
            ->first();

        if (!$invoice || !$invoice->invoice_pdf_url) {
            return response()->json([
                'success' => false,
                'error' => 'Invoice PDF not available'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'pdf_url' => $invoice->invoice_pdf_url,
        ]);
    }

    /**
     * Verify API key
     */
    private function verifyApiKey($apiKey)
    {
        $platforms = DB::table('platforms')
            ->where('status', 'active')
            ->select('id', 'api_key', 'api_key_hash', 'plan')
            ->get();

        foreach ($platforms as $platform) {
            if (\Illuminate\Support\Facades\Hash::check($apiKey, $platform->api_key_hash)) {
                return [
                    'id' => $platform->id,
                    'plan' => $platform->plan ?? 'free'
                ];
            }
        }

        $platform = DB::table('platforms')
            ->where('api_key', $apiKey)
            ->where('status', 'active')
            ->first();

        if ($platform) {
            return [
                'id' => $platform->id,
                'plan' => $platform->plan ?? 'free'
            ];
        }

        return null;
    }
}
