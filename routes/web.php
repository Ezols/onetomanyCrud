<?php

use App\User;
use App\Post;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function(){
    $user = User::findOrFail(1);
    $post = new Post;
    $post->title = "newwww";
    $post->body = "neeeeeeewwww";
    $user->post()->save($post);
});

Route::get('/read', function()
{
    $user = User::findOrFail(1);
    $posts = Post::whereUserId(1)->get();
    //dd($posts);
    // return $user->posts;

    foreach($user->posts as $post)
    {
        echo "Title: " . $post->title . "<br>";
        echo "Body: " . $post->body . "<br>";
    }
});

Route::get('/update', function()
{
    $userId = 1;
    $user = User::findOrFail($userId);
    $post = $userId ? Post::findOrFail(2) : new Post;
    $post->title = "Edited post";
    $post->body = "Updated body";

    $user->post()->save($post);

    return "Success";

    // $user = User::find(1);
    // $user->post()->whereId(1)->update(['title'=>'asdasdsa','body'=>'cxvxcvcxvx']);

});

Route::get('/delete', function()
{
    $userId = 1;
    $user = User::findOrFail($userId);
    $post = Post::whereUserId($userId)
        ->first()
        ->delete();

    // $user->post()->delete();

    return "Deleted";
});