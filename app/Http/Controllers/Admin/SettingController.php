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
        foreach ($request->except('_token') as $key => $value) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $path = $file->store('settings', 'public');
                Setting::set($key, $path, 'image', 'general');
            } else {
                Setting::set($key, $value, 'text', 'general');
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres généraux mis à jour avec succès.');
    }
}
