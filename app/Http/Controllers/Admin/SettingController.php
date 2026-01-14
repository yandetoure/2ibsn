<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $groups = [
            'general' => ['institute_name', 'institute_address', 'institute_phone', 'institute_email'],
            'appearance' => ['banner_image', 'logo_image'],
        ];

        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'setting_')) {
                $settingKey = str_replace('setting_', '', $key);
                Setting::set($settingKey, $value);
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres mis à jour avec succès.');
    }
}
