<?php

namespace App\Http\Controllers;

//import Model "Post
use App\Models\Post;

//return type View
use Illuminate\View\View;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get posts
        $posts = Post::latest()->paginate(5);

        //render view with posts
        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'title'     => 'required',
            'deskripsi'   => 'required',
            'status'   => 'required'
        ]);

       
        //create post
        Post::create([
            'title'     => $request->title,
            'deskripsi'   => $request->deskripsi,
            'status'   => $request->status
        ]);

        //redirect to index
        return redirect()->route(route:'posts.index')->with(key:['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        //get post by ID
        $post = Post::findOrFail($id);

        //render view with post
        return view('posts.show', compact('post'));
    }

    public function edit(string $id): View
    {
        //get post by ID
        $post = Post::findOrFail($id);

        //render view with post
        return view('posts.edit', compact('post'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //validate form
        $this->validate($request, [
            'title'     => 'required|min:5',
            'deskripsi'   => 'required|min:10',
            'status' => 'required|min:5'
        ]);

        //get post by ID
        $post = Post::findOrFail($id);

        
            $post->update([
                'title'     => $request->title,
                'deskripsi'   => $request->deskripsi,
                'status' => $request->status
            ]);

        
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        //get post by ID
        $post = Post::findOrFail($id);

        // //delete image
        // Post::delete('public/posts/'. $post->image);
    //     if (!$post) {
    //         return response()->json(['message' => 'Post not found'], 404);
    //     }

    //     $post->delete();

    //     return response()->json(['message' => 'Post deleted successfully']);
    // }
        //delete post
        $post->delete();

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function getCompletedTasks()
    {
        $completedTasks = Task::where('status', 'completed')->get();

        return response()->json(['data' => $completedTasks]);
    }

    public function getIncompleteTasks()
    {
        $incompleteTasks = Task::where('status', 'incomplete')->get();

        return response()->json(['data' => $incompleteTasks]);
    }

    public function updateTaskStatus($id, Request $request)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $status = $request->input('status');

        if ($status !== 'completed' && $status !== 'incomplete') {
            return response()->json(['message' => 'Invalid status'], 400);
        }

        $task->status = $status;
        $task->save();

        return response()->json(['message' => 'Task status updated successfully', 'data' => $task]);
    }


}
