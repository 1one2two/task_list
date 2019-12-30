<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Task;
use Illuminate\Http\Request;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'web'], function () {

    /**
     * Show Task Dashboard
     */
		Route::get('/', function () {
        $tasks = Task::orderBy('created_at', 'asc')->get();

        return view('tasks', [
            'tasks' => $tasks
        ]);
    });

    /**
     * Add New Task
     */
    Route::post('/task', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
              return redirect('/')
              ->withInput()
              ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name; //https://toolman.xyz/name;
        $task->is_complete = false;
        $task->likes = 0;
        $task->save();

        session()->flash('status', 'OK!? Task Created!');
        
        return redirect('/');
    });

    /**
     * Delete Task
     */
    Route::delete('/task/{task}', function (Task $task) {
        if($task->is_complete) {
            $task->delete();
        } else {
            $task->is_complete = true;
            $task->save();
        }
        
        /*$task->delete();*/
        return redirect('/');
    });


    Route::delete('/like/{task}', function (Task $task) {

        $task->likes = ($task->likes + 1);
        $task->save();

        return redirect('/');
    });
});