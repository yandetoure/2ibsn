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
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'setting_')) {
                $settingKey = str_replace('setting_', '', $key);

                if ($request->hasFile($key)) {
                    $file = $request->file($key);
                    $path = $file->store('settings', 'public');
                    Setting::set($settingKey, $path, 'image', 'appearance');
                } else {
                    // Determine group based on key if possible, default to general
                    $group = 'general';
                    if (in_array($settingKey, ['banner_image', 'logo_image', 'primary_color', 'secondary_color'])) {
                        $group = 'appearance';
                    }

                    Setting::set($settingKey, $value, 'text', $group);
                }
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres mis à jour avec succès.');
    }
}
