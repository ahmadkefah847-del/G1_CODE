<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminConsultationController extends Controller
{
    public function index(Request $request)
    {
        $query = Consultation::with('user');

        if ($search = $request->get('search')) {
            $query->where('title', 'like', "%{$search}%");
        }
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $consultations = $query->latest()->paginate(15)->withQueryString();
        $users = User::all();

        return view('admin.consultations', compact('consultations', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'date' => 'required|date',
        ]);

        Consultation::create($request->only('title', 'description', 'user_id', 'status', 'date'));

        return back()->with('success', __('admin.messages.consultation_created'));
    }

    public function update(Request $request, Consultation $consultation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'date' => 'required|date',
        ]);

        $consultation->update($request->only('title', 'description', 'status', 'date'));

        return back()->with('success', __('admin.messages.consultation_updated'));
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return back()->with('success', __('admin.messages.consultation_deleted'));
    }
}
