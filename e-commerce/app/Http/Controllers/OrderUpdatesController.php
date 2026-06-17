<?php

namespace App\Http\Controllers;

use App\Models\Order_Updates;
use Illuminate\Http\Request;

class OrderUpdatesController extends Controller
{
    public function update(Request $request, $id)
    {
        $order = Order_Updates::findOrFail($id);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()
            ->with('success', 'Status berhasil diupdate');
    }
}