<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\HistoryItem;

class HistoryController extends Controller
{
    public function index()
    {
        $user_id = auth()->id(); // Gets the authenticated user's ID
        $histories = History::where('user_id', $user_id)->get(); // Fetch histories related to the user

        return view('history.history', compact('histories'));
    }

    public function showHistoryItem($history_id)
    {
        $history = History::with('historyItems')->find($history_id);

        if (!$history) {
            return redirect('/history')->with('error', '缺少訂單編號');
        }

        return view('history.history-items', compact('history'));
    }
}
