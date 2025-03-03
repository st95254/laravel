<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\HistoryItem;

class HistoryController extends Controller
{
    public function index()
    {
        $user_id = auth()->id(); // Gets the authenticated user's ID
        $histories = History::where('user_id', $user_id)
                            ->orderBy('created_at', 'desc') // 按造創建時間降序排列
                            ->paginate(10);

        return view('history.history', compact('histories'));
    }

    public function showHistoryItems($history_id)
    {
        $history = History::with('historyItems')->find($history_id);

        if (!$history) {
            return redirect('/history')->with('error', '缺少訂單編號');
        }

        return view('history.history-items', compact('history'));
    }

    // Admin 功能
    public function showAllUserHistories()
    {
        $histories = History::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.history', ['histories' => $histories]);
    }

    public function searchUserHistoriesByEmail(Request $request)
    {
        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', '找不到該使用者');
        }

        $histories = History::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        return view('admin.history', ['histories' => $histories]);
    }

    public function searchHistoriesByTradeNo(Request $request)
    {
        if ($request->trade_no) {
            $histories = History::where('trade_no', 'like', '%'.$request->trade_no.'%')->paginate(10);
            return view('history.history', compact('histories'));
        } else {
            return back()->with('error', '請輸入訂單編號進行搜尋');
        }
    }

    public function updateHistoryStatus(Request $request)
    {
        $history = History::where('trade_no', $request->trade_no)->first();
        if ($history) {
            $history->status = $request->new_status;
            $history->save();
            return $this->searchHistoriesByTradeNo(new Request(['trade_no' => $request->trade_no]));
        } else {
            return back()->with('error', '找不到該筆訂單');
        }
    }
}
