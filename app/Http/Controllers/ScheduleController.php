<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * GET ALL SCHEDULES
     */
    public function index()
    {
        return response()->json(
            Schedule::latest()->get()
        );
    }

    /**
     * CREATE SCHEDULE
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $schedule = Schedule::create([

            'type' => $request->type,

            'title' => $request->title,

            'date' => $request->date,

            'time' => $request->time,

            'venue' => $request->venue,

            'agenda' => $request->agenda,

            /*
                Assigned members stored here
            */
            'members' => $request->members ?? [],
        ]);

        return response()->json([
            'message' => 'Schedule Created Successfully',
            'data' => $schedule
        ], 201);
    }

    /**
     * GET SINGLE SCHEDULE
     */
    public function show($id)
    {
        return response()->json(
            Schedule::findOrFail($id)
        );
    }

    /**
     * UPDATE SCHEDULE / ATTENDANCE
     */
    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->update([

            'type' => $request->type ?? $schedule->type,

            'title' => $request->title ?? $schedule->title,

            'date' => $request->date ?? $schedule->date,

            'time' => $request->time ?? $schedule->time,

            'venue' => $request->venue ?? $schedule->venue,

            'agenda' => $request->agenda ?? $schedule->agenda,

            /*
                Update attendance members here
            */
            'members' => $request->members ?? $schedule->members,
        ]);

        return response()->json([
            'message' => 'Schedule Updated Successfully',
            'data' => $schedule
        ]);
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->delete();

        return response()->json([
            'message' => 'Deleted Successfully'
        ]);
    }

      public function timeIn(Request $request, $scheduleId)
    {
        $request->validate([
            'memberId' => 'required',
            'status' => 'nullable|string',
            'selfie' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $schedule = Schedule::findOrFail($scheduleId);

        $members = $schedule->members ?? [];

        $found = false;

        foreach ($members as &$member) {

            if ($member['memberId'] == $request->memberId) {

                $member['status'] = $request->status ?? 'Present';

                $member['timeInStamp'] = now();

                /**
                 * OPTIONAL SELFIE
                 */
                if ($request->hasFile('selfie')) {

                    $path = $request->file('selfie')
                        ->store('attendance_selfies', 'public');

                    $member['selfie'] = asset('storage/' . $path);
                }

                $found = true;
                break;
            }
        }

        if (!$found) {
            return response()->json([
                'message' => 'Member not assigned to this schedule'
            ], 404);
        }

        $schedule->members = $members;
        $schedule->save();

        return response()->json([
            'message' => 'Time In Successful',
            'data' => $schedule
        ]);
    }

}