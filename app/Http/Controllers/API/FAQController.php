<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    // GET: /api/faqs
    public function index()
    {
        $faqs = faq::all();
        return response()->json([
            'status' => true,
            'message' => 'List semua FAQ',
            'data' => $faqs
        ]);
    }

    // GET: /api/faqs/{id}
    public function show($id)
    {
        $faq = faq::find($id);

        if (!$faq) {
            return response()->json([
                'status' => false,
                'message' => 'FAQ tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $faq
        ]);
    }
}
