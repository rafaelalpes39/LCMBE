<?php

namespace App\Http\Controllers;

use App\Models\MemberObligation;
use Illuminate\Http\Request;

class MemberObligationController extends Controller
{
    /**
     * GET ALL OBLIGATIONS
     */
    public function index()
    {
        $obligations = MemberObligation::with('user')
            ->latest()
            ->get();

        return response()->json($obligations);
    }

    /**
     * STORE NEW OBLIGATION
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'reason' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $obligation = MemberObligation::create([
            'user_id' => $validated['user_id'],
            'reason' => $validated['reason'],
            'amount' => $validated['amount'],
            'is_paid' => false,
        ]);

        return response()->json([
            'message' => 'Obligation created successfully',
            'data' => $obligation,
        ], 201);
    }

    /**
     * UPDATE OBLIGATION
     */
    public function update(Request $request, $id)
    {
        $obligation = MemberObligation::findOrFail($id);

        $validated = $request->validate([
            'reason' => 'sometimes|string|max:255',
            'amount' => 'sometimes|numeric|min:0',
            'is_paid' => 'sometimes|boolean',
        ]);

        $obligation->update($validated);

        return response()->json([
            'message' => 'Obligation updated successfully',
            'data' => $obligation,
        ]);
    }

    /**
     * DELETE OBLIGATION
     */
    public function destroy($id)
    {
        $obligation = MemberObligation::findOrFail($id);

        $obligation->delete();

        return response()->json([
            'message' => 'Obligation deleted successfully',
        ]);
    }
}