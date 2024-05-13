<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Repositories\Board\BoardInterface;
use App\Services\BoardServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BoardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        // dd($user_id);
        return app(BoardServices::class)->GetAllBoards($user_id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoardRequest $request)
    {
        $data = $request->validated();

        app(BoardServices::class)->StoreBoard($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        app(BoardServices::class)->ShowBoard($id);

        return response()->json([
            'data' => app(BoardServices::class)->ShowBoard($id)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBoardRequest $request, $id)
    {
        $data = $request->validated();
        app(BoardServices::class)->UpdateBoard($data, $id);

        return response()->json([
            'data' => app(BoardServices::class)->ShowBoard($id)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        app(BoardServices::class)->DeleteBoard($id);

        return response()->json([
            'message' => 'Board deleted successfully'
        ], 200);
    }
}
