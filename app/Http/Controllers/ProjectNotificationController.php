<?php

namespace App\Http\Controllers;

use App\Models\ProjectNotification;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user_id = Auth::id();

    // Fetch only notifications where remain_date is today
    $notifications = ProjectNotification::where('user_id', $user_id)
        ->whereHas('project', function ($query) {
            $query->whereDate('remain_date', now()->toDateString());
        })
        ->with('project') // Eager load project details
        ->latest()
        ->paginate(10);

    return view('notifications.index', compact('notifications'));
}


  public function checkRemainDateNotifications()
{
    $user_id = Auth::id();
    if (!$user_id) {
        return;
    }
    $today = \Carbon\Carbon::today(); 

    $projects = Project::where('user_id', $user_id)
        ->whereDate('remain_date', $today) // Only trigger notification on remain_date
        ->get();

    foreach ($projects as $project) {
        ProjectNotification::updateOrCreate(
            [
                'user_id' => $user_id,
                'project_id' => $project->id,
            ],
            [
                'message' => "Reminder: The project '{$project->client_name}' has reached its remain date ({$project->remain_date}).",
                'read_at' => null,
            ]
        );
    }
}

     public function markAsRead($id)
    {
        $notification = ProjectNotification::findOrFail($id);
        $notification->update(['read_at' => now()]);
        return back();
    }
    
    public function destroy($id)
{
    $notification = ProjectNotification::find($id);

    if (!$notification) {
        return back()->with('error', 'Notification not found!');
    }

    if ($notification->delete()) {
        return back()->with('success', 'Notification deleted successfully!');
    } else {
        return back()->with('error', 'Failed to delete notification.');
    }
}
}

