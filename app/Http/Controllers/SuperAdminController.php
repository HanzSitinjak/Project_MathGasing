<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuperAdminController extends Controller
{
    public function index()
    {
        $response = Http::get('https://mathgasing.cloud/api/data-managers');
        if ($response->ok()) {
            $admins = $response->json()['dataManagers'];

            $activeAdmins = array_filter($admins, function($admin) {
                return $admin['is_approved'] == '1';
            });

            $nonActiveAdmins = array_filter($admins, function($admin) {
                return $admin['is_approved'] == '2';
            });
        } else {
            $activeAdmins = [];
            $nonActiveAdmins = [];
        }

        return view('akun-admin.akun-admin', compact('activeAdmins', 'nonActiveAdmins'));
    }

    public function updateIsApproved(Request $request, $id)
    {
        $response = Http::post("https://mathgasing.cloud/api/StatusAdmins/{$id}", [
            'is_approved' => $request->is_approved
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return redirect()->back()->with('success', $data['message']);
        } else {
            return redirect()->back()->with('error', 'Gagal mengupdate status is_approved admin.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:active,non-active',
        ]);

        $response = Http::post("https://mathgasing.cloud/api/UpdateStatusAdmin/{$id}", [
            'status' => $validated['status']
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return redirect()->back()->with('success', $data['message']);
        } else {
            return redirect()->back()->with('error', 'Gagal mengupdate status admin.');
        }
    }
}
