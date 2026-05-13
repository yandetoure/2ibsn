<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Media;
use Illuminate\Http\Request;

class AppearanceController extends Controller
{
    public function hero()
    {
        $hero_title = Setting::get('hero_title', "Éducation d'Excellence");
        $hero_subtitle = Setting::get('hero_subtitle', "L'Institut International Baye Barhamou forme les leaders de demain à travers un cursus franco-islamique unique, de la maternelle au collège.");
        $hero_label = Setting::get('hero_label', "Fondé en 2016 · Dakar, Sénégal");
        $logo_image = Setting::get('logo_image');
        $banners = Media::where('type', 'banner')->orderBy('order')->get();

        return view('admin.appearance.hero', compact('hero_title', 'hero_subtitle', 'hero_label', 'logo_image', 'banners'));
    }

    public function updateHero(Request $request)
    {
        Setting::set('hero_title', $request->hero_title, 'text', 'appearance');
        Setting::set('hero_subtitle', $request->hero_subtitle, 'text', 'appearance');
        Setting::set('hero_label', $request->hero_label, 'text', 'appearance');

        if ($request->hasFile('logo_image')) {
            $file = $request->file('logo_image');
            $path = $file->store('settings', 'public');
            Setting::set('logo_image', $path, 'image', 'general');
        }

        if ($request->hasFile('banners')) {
            $files = $request->file('banners');
            foreach ($files as $file) {
                $path = $file->store('media', 'public');
                Media::create([
                    'type' => 'banner',
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'order' => Media::where('type', 'banner')->count(),
                    'is_active' => true,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Contenu Hero et Logo mis à jour avec succès.');
    }

    public function colors()
    {
        $primary_color = Setting::get('primary_color', '#1a4d2e');
        $secondary_color = Setting::get('secondary_color', '#d4af37');
        $accent_color = Setting::get('accent_color', '#f5f5f0');

        return view('admin.appearance.colors', compact('primary_color', 'secondary_color', 'accent_color'));
    }

    public function updateColors(Request $request)
    {
        Setting::set('primary_color', $request->primary_color, 'text', 'appearance');
        Setting::set('secondary_color', $request->secondary_color, 'text', 'appearance');
        Setting::set('accent_color', $request->accent_color, 'text', 'appearance');

        return redirect()->back()->with('success', 'Couleurs mises à jour avec succès.');
    }

    public function resetColors()
    {
        Setting::set('primary_color', '#1a4d2e', 'text', 'appearance');
        Setting::set('secondary_color', '#d4af37', 'text', 'appearance');
        Setting::set('accent_color', '#f7f5f0', 'text', 'appearance');

        return redirect()->back()->with('success', 'Couleurs réinitialisées aux valeurs par défaut.');
    }

    public function gallery()
    {
        $media = Media::where('type', 'gallery')->orderBy('order')->orderBy('created_at', 'desc')->paginate(24);
        return view('admin.appearance.gallery', compact('media'));
    }

    public function events()
    {
        $events = Media::where('type', 'event')->orderBy('order')->orderBy('created_at', 'desc')->paginate(12);
        $show_events = Setting::get('show_events_section', false);
        return view('admin.appearance.events', compact('events', 'show_events'));
    }

    public function toggleEventsSection(Request $request)
    {
        Setting::set('show_events_section', $request->has('show_events_section') ? '1' : '0', 'boolean', 'appearance');
        return redirect()->back()->with('success', 'Visibilité de la section événements mise à jour.');
    }
}
