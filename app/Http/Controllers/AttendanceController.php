<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();   // 認証済みユーザーの取得

        // 最新の勤怠レコードを取得
        $latestAttendance = Attendance::where('staff_id', $user->id)
            ->latest('event_at')
            ->first();

        // ステータス名を決定して user にセット
        if ($latestAttendance) {
            $user->attendance_status = $latestAttendance->status->event_type;
        } else {
            $user->attendance_status = '勤務外'; // データがない場合は勤務外
        }

        // $statusname = $request->input('statusname');
        $formattedDate = now()->format('Y年n月j日(D)');
        $formattedTime = $request->input('time');

        return view('user.attendance-register', [
            'user' => $user,
            // 'statusname' => $statusname,
            'formattedDate' => $formattedDate,
            'formattedTime' => $formattedTime,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
