<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyTip;
use Illuminate\Http\Request;

class DailyTipController extends Controller
{
    public function index()
    {
        $tips = DailyTip::orderBy('day_number')->paginate(30);
        return view('admin.daily-tips.index', compact('tips'));
    }

    public function create()
    {
        return view('admin.daily-tips.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'day_number' => 'required|integer|min:1|max:365|unique:daily_tips',
            'tip_ar' => 'required|string',
            'tip_en' => 'nullable|string',
        ]);

        DailyTip::create($request->all());
        return redirect()->route('admin.daily-tips.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function edit(DailyTip $dailyTip)
    {
        return view('admin.daily-tips.edit', compact('dailyTip'));
    }

    public function update(Request $request, DailyTip $dailyTip)
    {
        $request->validate([
            'tip_ar' => 'required|string',
            'tip_en' => 'nullable|string',
        ]);

        $dailyTip->update($request->all());
        return redirect()->route('admin.daily-tips.index')->with('success', 'تم التعديل بنجاح');
    }

    public function destroy(DailyTip $dailyTip)
    {
        $dailyTip->delete();
        return redirect()->route('admin.daily-tips.index')->with('success', 'تم الحذف بنجاح');
    }
}