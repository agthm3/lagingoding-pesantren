<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Exception;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->get();
        return view('dashboard.faq.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban'    => 'required|string',
        ]);

        try {
            Faq::create($request->all());
            return redirect()->route('dashboard.faq.index')->with('success', 'Butir tanya jawab FAQ baru berhasil diterbitkan.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menambah FAQ: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban'    => 'required|string',
        ]);

        try {
            $faq = Faq::findOrFail($id);
            $faq->update($request->all());
            return redirect()->route('dashboard.faq.index')->with('success', 'Data materi FAQ berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $faq = Faq::findOrFail($id);
            $faq->delete();
            return redirect()->route('dashboard.faq.index')->with('success', 'Materi FAQ berhasil dihapus permanen.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}