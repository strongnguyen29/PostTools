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
     * @throws FacebookSDKException
     */
    public function __construct(Facebook $fb)
    {
        $this->fb = $fb;
        $token = $this->getAccessToken();
        dd($token);
        if (empty($this->fb->getDefaultAccessToken()->getValue())) {

            try {

                $this->fb->setDefaultAccessToken($token);
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
        return $this->fb->get('/' . config('app.fanpage_id') . '?fields=access_token');
    }
}
