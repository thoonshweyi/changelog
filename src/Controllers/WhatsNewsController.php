<?php

namespace App\Http\Controllers;

use App\Models\WhatsNew;
use App\Models\ChangeLog;
use Illuminate\Http\Request;
use App\Http\Resources\ChangeLogsResource;

class WhatsNewsController extends Controller
{
    public function index(Request $request){
        $whatsnews = WhatsNew::getAuthUserWhatNews($request->status);
        // $changelog_ids = $whatnews->pluck("change_log_id");
        // $changelogs = ChangeLog::whereIn("id",$changelog_ids)->get();

        // ajax route
        if($request->ajax()){
            $whatsnews = WhatsNew::getAuthUserWhatNews($request->status);
            $changelog_ids = $whatsnews->pluck("change_log_id");
            $changelogs = ChangeLog::whereIn("id",$changelog_ids)->get();

            return  ChangeLogsResource::collection($changelogs);
        }

        return view('whatsnews.index',compact('whatsnews'));
    }


}
