<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\View\View;
class InfoController extends Controller
{
    public function index(): View
    {
        return view("info.index", ["models" => Info::all()]);
    }
    public function create(): View
    {
        return view("info.create");
    }
    public function store(FormRequest $request)/*:  Application | RedirectResponse */
    {
        $data = $request->validate([
            'first_name' => 'required|max:50|min:3',
            'last_name' => 'required|max:50|min:3',
            'is_active' => 'boolean',
            'birthday' => 'required',
        ]);

        $model = new Info();
        $model->fill($data);
        $model->save();

        return to_route('info.index');
    }
    public function edit(Info $info): View
    {
        return view("info.edit",["model" => $info]);
    }

    public function update(FormRequest $request)/*:  Application | RedirectResponse */
    {
        $data = $request->validate([
            'id' => 'required',
            'first_name' => 'required|max:50|min:3',
            'last_name' => 'required|max:50|min:3',
            'is_active' => 'boolean',
            'birthday' => 'required',
        ]);

        /**
         * @var Info $model
         */
        $model = Info::where("id","=", $data['id'])->first();
        $model->fill($data);
        $model->update();

        return to_route('info.index');
    }

    public function info(Info $info): View
    {
        return view("info.info",["model" => $info]);
    }

    public function delete(Info $info)
    {
       $info->delete();
        return to_route('info.index');
    }
}
