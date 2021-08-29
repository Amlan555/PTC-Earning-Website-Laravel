<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Task::latest()->get();
        return view('admin.task.all',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.task.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required | max:255',
            'duration' => 'required | numeric',
            'video_id' => 'required | max:255',
            'channel_id' => 'required | max:255',
            'amount' => 'required | numeric',
            'status' => 'required',
        ]);
        function createSlug($title, $id = 0)
        {
            $slug = Str::slug($title);
            $allSlugs = getRelatedSlugs($slug, $id);
            if (! $allSlugs->contains('slug', $slug)){
                return $slug;
            }
    
            $i = 2;
            $is_contain = true;
            do {
                $newSlug = $slug . '-' . $i;
                if (!$allSlugs->contains('slug', $newSlug)) {
                    $is_contain = false;
                    return $newSlug;
                }
                $i++;
            } while ($is_contain);
        }
        function getRelatedSlugs($slug, $id = 0)
        {
            return Task::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
        }
        $slug = createSlug($request->title);
        $task = new Task();
        $task->title = $request->title;
        $task->slug = $slug;
        $task->duration = $request->duration;
        $task->video_id = $request->video_id;
        $task->channel_id = $request->channel_id;
        $task->amount = $request->amount;
        $task->status = $request->status;
        $task->save();
        Toastr::info("Task has been added","Success");
        return redirect()->route('admin.task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('admin.task.edit',['data'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request,[
            'title' => 'required | max:255',
            'duration' => 'required | numeric',
            'video_id' => 'required | max:255',
            'channel_id' => 'required | max:255',
            'amount' => 'required | numeric',
            'status' => 'required',
        ]);
        function createdSlug($title, $id)
        {
            $slug = Str::slug($title);
            $allSlugs = getRelatedSlug($slug, $id);
            if (! $allSlugs->contains('slug', $slug)){
                return $slug;
            }
    
            $i = 2;
            $is_contain = true;
            do {
                $newSlug = $slug . '-' . $i;
                if (!$allSlugs->contains('slug', $newSlug)) {
                    $is_contain = false;
                    return $newSlug;
                }
                $i++;
            } while ($is_contain);
        }
        function getRelatedSlug($slug, $id)
        {
            return Task::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
        }
        $slug = createdSlug($request->title, $task->id);
        $task->title = $request->title;
        $task->slug = $slug;
        $task->duration = $request->duration;
        $task->video_id = $request->video_id;
        $task->channel_id = $request->channel_id;
        $task->amount = $request->amount;
        $task->status = $request->status;
        $task->save();
        Toastr::info("Task has been updated","Success");
        return redirect()->route('admin.task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        Toastr::info("Task has been deleted","Success");
        return redirect()->back();
    }
}
