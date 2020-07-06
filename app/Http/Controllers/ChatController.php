<?php

namespace App\Http\Controllers;

use App\User;
use App\ChatMessage;
use App\Http\Resources\ChatResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function userList()
    {
        $data = [];

        $userModels = User::where('id', '!=', Auth::user()->id)->get();
        $list = [];
        if (!empty($userModels)) {
            foreach ($userModels as $model) {
                $list[] = $model->asJson($model);
            }
            $data['chat_list'] = $list;
        } else {
            $data['error'] = "No chat found.";
        }
        return response()->json($data);
    }

    public function loadChat($id, $page = 0)
    {
        $data = [];
        $toUser = User::where('id', $id)->first();
        $query = ChatMessage::get();
        $list = [];
        if (!empty($query)) {
            foreach ($query as $model) {
                $list[] = $model->asCustomJson();
            }
            $data['chat_messages'] = $list;
            $data['page'] = $page;
        } else {
            $data['error'] = "No chat found.";
        }
        $data['user_detail'] = !empty($toUser) ? $toUser->asJson($toUser) : "";
        return $data;
    }

    public function sendMessage(Request $request)
    {
        $data = [];
        $chat = new ChatMessage();
        if (!empty($request->input('message'))) {
            // $fromID = Auth::user()->id;
            $chat->message = $request->input('message');
            $chat->from_user_id = $request->input('from_user_id');
            $chat->to_user_id = $request->input('to_user_id');
            $chat->is_read = ChatMessage::IS_READ_NO;
            $chat->type_id = ChatMessage::TYPE_TEXT_MESSAGE;
            if (!$chat->save()) {
                $data['error'] = "some error occur to send message";
            } else {
                $data['message'] = $chat->asCustomJson();
            }
        }
        return $data;
    }

    public function getMessage(Request $request)
    {

        $data = [];
        $chat = ChatMessage::where('to_user_id', $request->input('id'))->latest()->get();
        if (!empty($chat)) {
            $data['message'][] = ChatResource::collection($chat);
        } else {
            $data['error'] = "no message found";
        }
        return $data;
    }

    public function allMessage(Request $request)
    {
        $data = [];
        $chat = ChatMessage::where('to_user_id', $request->input('to'))
            ->where('from_user_id', $request->input('from'))
            ->orWhere('from_user_id', $request->input('to'))
            ->orWhere('to_user_id', $request->input('from'))
            ->latest()
            ->get();
        // print_r($chat->toSql());
        // exit;
        if (!empty($chat)) {
            $data['message'][] = ChatResource::collection($chat);
        } else {
            $data['error'] = "no message found";
        }
        return $data;
    }
}
