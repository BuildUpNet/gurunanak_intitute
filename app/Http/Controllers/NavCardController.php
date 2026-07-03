<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class NavCardController extends Controller
{
    private array $cards = [
        ['key' => 'nav_card_ug',          'label' => 'Under Graduate', 'file' => 'nav-ug.jpg'],
        ['key' => 'nav_card_pg',          'label' => 'Post Graduate',  'file' => 'nav-pg.jpg'],
        ['key' => 'nav_card_diploma',     'label' => 'Diploma',        'file' => 'nav-diploma.jpg'],
        ['key' => 'nav_card_certificate', 'label' => 'Certificate',    'file' => 'nav-certificate.jpg'],
    ];

    public function index()
    {
        $settings = [];
        foreach ($this->cards as $card) {
            $settings[$card['key']] = SiteSetting::get($card['key']);
        }
        return view('admin.nav-cards.index', [
            'cards'    => $this->cards,
            'settings' => $settings,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        foreach ($this->cards as $card) {
            $fieldName = 'images.' . $card['key'];
            if ($request->hasFile($fieldName) && $request->file($fieldName)->isValid()) {
                $file = $request->file($fieldName);
                $path = $file->move(public_path('images/programs'), $card['file']);
                SiteSetting::set($card['key'], 'images/programs/' . $card['file']);
            }
        }

        return back()->with('success', 'Nav card images updated successfully.');
    }
}
