<?php

namespace App\Http\Controllers;

use App\Http\Services\UploadFileService;
use App\Models\Image;
use App\Models\Info;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
class InfoController extends Controller
{
    public function index(int $pag = 0, ?FormRequest $request): View
    {
        $beforePagination = [];
        if ($request) {
            $beforePagination = Info::whereRaw('(lower(first_name) like ?) or (lower(last_name) like ?)', ["%{$request['search']}%", "%{$request['search']}%"])->get();
        } else
            $beforePagination = Info::all();

        return view("info.index", [
            "models" => $beforePagination->skip($pag * 5)->take(5),
            "count" => count($beforePagination),
            "currentPage" => $pag
        ]);
    }
    public function create(): View
    {
        return view("info.create");
    }
    public function store(FormRequest $request, UploadFileService $service)
    {
        $data = $request->validate([
            'image' => 'image|max:2048',
            'first_name' => 'required|max:50|min:3',
            'last_name' => 'required|max:50|min:3',
            'is_active' => 'boolean',
            'birthday' => 'required',
        ]);

        $model = new Info();
        $model->fill($data);

        if(request()->hasFile('image')){
            $service->setImage($request->file('image'),$model,'infos');
        }

        $model->save();

        return to_route('info.index',[0]);
    }
    public function edit(Info $info): View
    {
        return view("info.edit", ["model" => $info]);
    }

    public function update(Info $prevInfo, FormRequest $request, UploadFileService $service)
    {
        $data = $request->validate([
            'image' => 'image|max:2048',
            'first_name' => 'required|max:50|min:3',
            'last_name' => 'required|max:50|min:3',
            'is_active' => 'boolean',
            'birthday' => 'required',
        ]);

        $prevInfo->fill($data);

        
        if(request()->hasFile('image')){
            $service->setImage($request->file('image'),$prevInfo,'infos');
        }

        $prevInfo->update();

        return to_route('info.index',[0]);
    }

    public function info(Info $info): View
    {
        return view("info.info", ["model" => $info]);
    }

    public function delete(Info $info)
    {
        if($info->image){
            $info->image->delete();
        }
        $info->delete();
        return to_route('info.index',[0]);
    }
}
