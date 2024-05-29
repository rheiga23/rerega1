<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Temukan user berdasarkan ID

        $user->delete(); // Hapus user dari database

        return redirect()->route('dashboard')->with('success', 'Data berhasil dihapus.'); // Redirect kembali ke dashboard dengan pesan sukses
    }
    
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'edit-name' => 'required|string|max:255',
            'edit-email' => 'required|string|email|max:255',
            'edit-password' => 'required|string|min:8',
        ]);

        // Ambil data pengguna dari ID
        $user = User::findOrFail($id);

        // Update data pengguna dengan data baru dari formulir
        $user->name = $request->input('edit-name');
        $user->email = $request->input('edit-email');
        $user->password = bcrypt($request->input('edit-password')); // Pastikan untuk mengenkripsi password
        $user->save();

        // Redirect ke halaman yang sesuai setelah pembaruan berhasil
        return redirect()->route('dashboard')->with('success', 'Data pengguna berhasil diperbarui!');
    }
}