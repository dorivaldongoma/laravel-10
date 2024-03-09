<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support)
    {
        $supports = $support->all();

        return view('admin/supports/index', compact('supports'));
    }
    public function create()
    {
        return view('admin/supports/create');
    }
    public function store(StoreUpdateSupportRequest $request, Support $support)
    {
        $data = $request->validated();
        $data['status'] = 'a';

        $support->create($data);

        return redirect()->route('supports.index');
    }
    public function show(string|int $id)
    {
        //$support = Support::where('id', '=', '$id')->first();
        //$support = Support::find($id);
        if(!$support = Support::where('id', $id)->first()){
            return back();
        }
        return view('admin/supports/show', compact('support'));
    }
    public function edit(string|int $id, Support $support)
    {
        if(!$support = $support::where('id', $id)->first()){
            return back();
        }
        return view('admin/supports/edit', compact('support'));
    }
    public function update(string $id, StoreUpdateSupportRequest $request, Support $support)
    {
        if(!$support = $support->where('id', $id)){
            return back();
        }

        $support->update($request->validated());

        return redirect()->route('supports.index');
    }
    public function destroy(string $id, Request $request, Support $support)
    {
        if(!$support = $support->where('id', $id)){
            return back();
        }

        $support->delete();

        return redirect()->route('supports.index');
    }
}
