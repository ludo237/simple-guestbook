<?php namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Class GuestbookController
 *
 * @author  Claudio Ludovico Panetta (@Ludo237)
 * @package App\Http\Controllers
 */
final class GuestbookController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    final public function retrieveMessages()
    {
        // TODO: If there's a better solution for this, I'm listening...
        $messages = DB::table("messages")->get();
        $messages = collect($messages);
        $messages->each(function($message){
            $humans = Carbon::createFromFormat("Y-m-d H:i:s", $message->created_at)->diffForHumans();
            $message->created_at = $humans;
        });

        // Return the collection
        return response()->json($messages);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    final public function postMessage(Request $request)
    {
        // Flow breaking validation
        $this->validate($request, [
            'name' => 'required|max:255',
            'message' => 'required',
        ]);

        // Insert the new message and get the id, for a fast debug
        $id = DB::table("messages")->insertGetId(
            [
                'name' => $request->name,
                'message' => $request->message,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        // Print a nice message
        return response()->json("Messaged posted: {$id}. Thank you!", 200);
    }
}
