<?php

namespace App\Http\Controllers;

use App\Model\Jawaban;
use App\Model\Pertanyaan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pertanyaan = new Pertanyaan;
        $jawaban = new Jawaban;
        return view('dashboard', compact(['pertanyaan', 'jawaban']));
    }
}
