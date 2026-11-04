<?php

namespace App\Http\Controllers;

use App\Models\SellerLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SellerLeadController extends Controller
{
    /**
     * Show the public "Become a Seller" registration form.
     */
    public function showRegisterForm()
    {
        return view('auth.seller_register');
    }

    /**
     * Handle public "Become a Seller" form submission.
     */
    public function submitRegister(Request $request)
    {
        $validated = $request->validate([
            'shop_name'         => 'required|string|max:255',
            'owner_name'        => 'required|string|max:255',
            'mobile_number'     => 'required|string|min:10|max:15',
            'email'             => 'nullable|email|max:255',
            'pincode'           => 'required|string|max:20',
            'city'              => 'nullable|string|max:100',
            'business_category' => 'nullable|string|max:100',
            'gstin_or_uin'      => 'nullable|string|max:50',
            'gstin'             => 'nullable|string|max:50',
            'uin'               => 'nullable|string|max:50',
            'address'           => 'nullable|string|max:1000',
            'message'           => 'nullable|string|max:1000',
        ]);

        $rawTaxId = trim($request->input('gstin_or_uin') ?? $request->input('gstin') ?? $request->input('uin') ?? '');
        if (empty($rawTaxId)) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please enter GSTIN or UIN.',
                    'errors'  => ['gstin_or_uin' => ['Please enter GSTIN or UIN.']]
                ], 422);
            }
            return back()->withErrors(['gstin_or_uin' => 'Please enter GSTIN or UIN.'])->withInput();
        }

        $pincodeValue = !empty($validated['pincode']) ? trim($validated['pincode']) : (!empty($validated['city']) ? trim($validated['city']) : null);

        // Determine whether entered tax ID is standard GSTIN (15 chars) or UIN
        $cleanTaxId = strtoupper($rawTaxId);
        $isGstin = preg_match('/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/i', $cleanTaxId) || (strlen($cleanTaxId) === 15 && ctype_alnum($cleanTaxId) && is_numeric(substr($cleanTaxId, 0, 2)));

        $leadData = [
            'shop_name'         => trim($validated['shop_name']),
            'owner_name'        => trim($validated['owner_name']),
            'mobile_number'     => trim($validated['mobile_number']),
            'email'             => !empty($validated['email']) ? trim($validated['email']) : null,
            'business_category' => !empty($validated['business_category']) ? trim($validated['business_category']) : null,
            'gstin'             => $isGstin ? $cleanTaxId : null,
            'uin'               => !$isGstin ? $cleanTaxId : null,
            'address'           => !empty($validated['address']) ? trim($validated['address']) : null,
            'message'           => !empty($validated['message']) ? trim($validated['message']) : null,
            'status'            => 'Pending',
        ];

        // If pincode column exists, save to it; also keep city filled for backwards compatibility
        if (\Illuminate\Support\Facades\Schema::hasColumn('seller_leads', 'pincode')) {
            $leadData['pincode'] = $pincodeValue;
            $leadData['city'] = $pincodeValue;
        } elseif (\Illuminate\Support\Facades\Schema::hasColumn('seller_leads', 'city')) {
            $leadData['city'] = $pincodeValue;
        }

        SellerLead::create($leadData);

        $message = 'Request submitted successfully! Admin will contact you soon.';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Display list of seller leads/requests for Admin.
     */
    public function adminIndex(Request $request)
    {
        $query = SellerLead::query();

        if ($request->filled('keyword')) {
            $kw = trim($request->input('keyword'));
            $query->where(function ($q) use ($kw) {
                $q->where('shop_name', 'like', "%{$kw}%")
                  ->orWhere('owner_name', 'like', "%{$kw}%")
                  ->orWhere('mobile_number', 'like', "%{$kw}%")
                  ->orWhere('email', 'like', "%{$kw}%")
                  ->orWhere('city', 'like', "%{$kw}%");
                if (\Illuminate\Support\Facades\Schema::hasColumn('seller_leads', 'pincode')) {
                    $q->orWhere('pincode', 'like', "%{$kw}%");
                }
                $q->orWhere('business_category', 'like', "%{$kw}%")
                  ->orWhere('gstin', 'like', "%{$kw}%")
                  ->orWhere('uin', 'like', "%{$kw}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $leads = $query->orderBy('id', 'desc')->get();

        $totalCount     = SellerLead::count();
        $pendingCount   = SellerLead::where('status', 'Pending')->count();
        $contactedCount = SellerLead::where('status', 'Contacted')->count();
        $approvedCount  = SellerLead::where('status', 'Approved')->count();

        return view('layout.admin.seller_leads.index', compact(
            'leads',
            'totalCount',
            'pendingCount',
            'contactedCount',
            'approvedCount'
        ));
    }

    /**
     * Update the status / notes of a seller lead.
     */
    public function adminUpdateStatus(Request $request, $id)
    {
        $lead = SellerLead::findOrFail($id);

        $status = $request->input('status');
        if ($status === '1' || $status === 1) {
            $status = 'Approved';
        } elseif ($status === '0' || $status === 0) {
            $status = 'Pending';
        }

        $lead->status = $status;
        if ($request->has('admin_notes')) {
            $lead->admin_notes = $request->input('admin_notes');
        }
        $lead->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
        }

        return redirect()->back()->with('success', 'Seller request status updated successfully!');
    }

    /**
     * Delete a seller lead.
     */
    public function adminDestroy($id)
    {
        $lead = SellerLead::findOrFail($id);
        $lead->delete();

        return redirect()->back()->with('success', 'Seller request deleted successfully!');
    }
}

