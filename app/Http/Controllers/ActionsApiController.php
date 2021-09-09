<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ActionsApiController extends Controller
{
    public function index()
    {
        return Action::all();
    }

    public function indexByUserId($id): Collection
    {
        return DB::table('actions')->where('user_id', $id)->get();
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id'=> 'required'
        ]);

        return Action::create([
            'title'=> request('title'),
            'content'=> request('content'),
            'user_id'=> request('user_id')
        ]);
    }

    public function update(Action $action): array
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $success = $action->update([
            'title'=> request('title'),
            'content'=> request('content')
        ]);

        return [
            'success'=> $success
        ];
    }

    public function destroy(Action $action): array
    {
        $success = $action->delete();

        return [
            'success'=> $success
        ];
    }

    public function watch(): Collection
    {
        return DB::table('actions')
            ->join('users', function ($join) {
                $join->on('actions.user_id', '=', 'users.id')
                    ->where('users.id', '=', '1');
            })->get();
    }
}
