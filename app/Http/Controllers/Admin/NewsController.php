<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // list news
    public function list() {}

    // create news
    public function create()
    {
        return view('Admin.News.update');
    }

    public function store() {}

    // edit news
    public function edit() {}

    public function update() {}

    // delete news
    public function delete() {}

    // detail news
    public function detail($id) {}

    // publish news
    public function publish($id, $publish) {}
}
