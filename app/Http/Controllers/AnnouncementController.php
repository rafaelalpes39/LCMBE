<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
  public function index()
    {
        $announcements = Announcement::with('user')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $announcements
        ]);
    }

 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'recipient' => 'required|string',
            'accomplished' => 'nullable|boolean',
        ]);

        $announcement = Announcement::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'recipient' => $validated['recipient'],
            'accomplished' => $validated['accomplished'] ?? false,
            'user_id' => 5,
            // 'user_id' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Announcement created successfully.',
            'data' => $announcement
        ], 201);
    }

    
    public function show($id)
    {
        $announcement = Announcement::with('user')->find($id);

        if (!$announcement) {
            return response()->json([
                'success' => false,
                'message' => 'Announcement not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $announcement
        ]);
    }

    
    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return response()->json([
                'success' => false,
                'message' => 'Announcement not found.'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'recipient' => 'required|string',
            'accomplished' => 'required|boolean',
        ]);

        $announcement->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Announcement updated successfully.',
            'data' => $announcement
        ]);
    }

    
    public function destroy($id)
    {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return response()->json([
                'success' => false,
                'message' => 'Announcement not found.'
            ], 404);
        }

        $announcement->delete();

        return response()->json([
            'success' => true,
            'message' => 'Announcement deleted successfully.'
        ]);
    }
}
