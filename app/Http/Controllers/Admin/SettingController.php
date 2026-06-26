<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private array $keys = [
        'site_phone', 'site_whatsapp', 'site_email', 'company_name',
        'company_vat', 'working_hours', 'address',
        'facebook_url', 'instagram_url',
        // Crypto payment settings
        'crypto_enabled',        // '1' or '0'
        'crypto_wallet_address', // e.g. 0x123...
        'crypto_network',        // e.g. TRC-20 (USDT), ERC-20 (ETH), BTC, etc.
        'crypto_currency',       // e.g. USDT, BTC, ETH
        // Ameria Bank (disabled for now, config ready for future activation)
        'ameria_bank_enabled',   // '0' — disabled, '1' — active
        'ameria_bank_merchant',  // Merchant ID when enabled
    ];

    public function edit()
    {
        $settings = [];
        foreach ($this->keys as $key) {
            $settings[$key] = Setting::get($key, '');
        }

        return view('admin.settings.edit', ['settings' => $settings]);
    }

    public function update(Request $request)
    {
        foreach ($this->keys as $key) {
            // Boolean toggles — store as '1'/'0'
            if (in_array($key, ['crypto_enabled', 'ameria_bank_enabled'], true)) {
                Setting::set($key, $request->boolean($key) ? '1' : '0');
            } else {
                Setting::set($key, $request->input($key, ''));
            }
        }

        return redirect()->route('admin.settings.edit')->with('success', __('admin.saved'));
    }
}
