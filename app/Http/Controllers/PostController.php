<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function userPosts($id){
//      return DB::table('posts')->where('user_id',$id)->orderBy('lokalizacja', 'DESC')->get();

        $response = Post::where('user_id',$id)->get();

        if ($response){
            return response($response, 200);
        }
        else{
            $response = ["message" =>'Error'];
            return response($response, 422);
        }
    }

    public function createPost(Request $request){
        $post = new Post();
        $post->user_id = $request->id;
        $post->tytul = $request->tytul;
        $post->cena = $request->cena;
        $post->kategoria = $request->kategoria;
        $post->lokalizacja = $request->lokalizacja;
        $post->opis = $request->opis;
        $post->save();

        if ($post){
            return response('Post created successfully', 200);
        }
        else{
            return response('Error', 422);
        }
    }

    public function deletePost($id){
        $post = Post::find($id);

        if ($post){
            $post->delete();
            return response('Post deleted successfully', 200);
        }
        else{
            $response = ["message" =>'Error'];
            return response($response, 422);
        }
    }

    public function editPost(Request $request){

        $id = $request->id;
        $post_tytul = $request->tytul;
        $post_cena = $request->cena;
        $post_kategoria = $request->kategoria;
        $post_lokalizacja = $request->lokalizacja;
        $post_opis = $request->opis;

        DB::update('update posts set tytul = ?, cena = ?, kategoria = ?, lokalizacja = ?, opis = ? where id = ?',
            [$post_tytul, $post_cena, $post_kategoria, $post_lokalizacja, $post_opis, $id ]);

        $response = ["Message" =>'Post edited successfully'];
        return response($response, 200);
    }

    public function findPostById($id){
        $response = Post::find($id);

        if ($response){
            return response($response, 200);
        }
        else{
            return response('Error', 422);
        }
    }

    public function getPosts(){
        $users = User::orderBy('id','ASC')->get();
        foreach($users as $user){
            $response[$user->name] = Post::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        }

        return $response;
    }

    public function getAllPostsUnfiltered(){
        $response = Post::orderBy('created_at', 'DESC')->get();

        return $response;
    }
}
