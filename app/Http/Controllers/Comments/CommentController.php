<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::anyApprovalStatus()->orderBy('created_at', 'desc')->paginate(10);

        return view('backend.comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        return back()->with('status', 'Komentarz dodany! Zostanie opublikowany po zaakceptowaniu!');
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $reply->body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $post = Post::find($request->get('post_id'));

        $post->comments()->save($reply);

        return back()->with('status', 'Komentarz dodany! Zostanie opublikowany po zaakceptowaniu!');

    }


    public function update(Request $request, $id)
    {

        $id = Comment::anyApprovalStatus()->find($id);
        $value = $request['value'];

        switch($value)
        {
            case 0:
                $id->approve();
                break;
            case 1:
                $id->suspend();
                break;
            case 2:
                $id->reject();
                break;
            default:
                break;
        }

        return redirect()->back()->with('message', 'Operation Successful !');
    }


    public function destroy(int $id): JsonResponse
    {
        $id = Comment::anyApprovalStatus()->find($id);

        try {
            $id->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }
    }
}
