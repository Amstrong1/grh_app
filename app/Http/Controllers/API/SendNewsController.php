<?php

namespace App\Http\Controllers\API;

use App\Models\Addon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SendNewsResource;

class SendNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = Addon::where('active', 1)->get();
        return SendNewsResource::collection($news);
    }
}
