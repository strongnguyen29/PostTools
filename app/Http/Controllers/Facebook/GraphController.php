<?php

namespace App\Http\Controllers\Facebook;

use App\Http\Controllers\Controller;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GraphController extends Controller
{
    /**
     * @var Facebook
     */
    protected $fb;

    /**
     * GraphController constructor.
     * @param $fb
     */
    public function __construct(Facebook $fb)
    {
        $this->fb = $fb;
        if ($this->fb->getDefaultAccessToken() == null) {
            try {
                $this->fb->setDefaultAccessToken($this->getAccessToken());
            } catch (FacebookSDKException $e) {
                Log::error($e);
            }
        }
    }

    public function index() {
        return view('facebook.page_post');
    }


    public function post(Request $request) {
        $content = $request->get('post_content');
        try {
            $result = $this->fb->get('/feed?message=' . $content, $this->fb->getDefaultAccessToken());
            dd($result);
        } catch (FacebookSDKException $e) {
            //Log::error($e);
            dd($e);
            //return back()->withErrors(['Lỗi post bài: ' . $e->getMessage()]);
        }
    }

    /**
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    protected function getAccessToken() {
        $this->fb->get('/' . config('app.fanpage_id') . '?fields=access_token');
    }
}
