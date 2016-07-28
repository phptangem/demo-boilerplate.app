<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function testWith()
    {
        return view('test.test')->withFlashDanger('hihi');
    }
    public function testParams()
    {
        return route('test.testParams',[1,2,3]);
    }

    public function testSession()
    {
        dd(session()->all());
    }
}
