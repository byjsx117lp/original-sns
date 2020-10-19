<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\SearchPostsRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::orderBy('updated_at', 'desc')->orderBy('id', 'desc')->paginate(5);
        
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //チェックされた数が上限未満であった場合、上限までnullを追加する処理
        $parts = $request->parts;
        $cnt_parts = count($parts);
        if($cnt_parts <= 7) {
            for($cnt_parts; $cnt_parts<=7; $cnt_parts++) {
                $parts[] = null;
            }
        }

        //チェックされた数が上限未満であった場合、上限までnullを追加する処理
        $areas = $request->areas;
        $cnt_areas = count($areas);
        if($cnt_areas <= 4) {
            for($cnt_areas; $cnt_areas<=4; $cnt_areas++) {
                $areas[] = null;
            }
        }

        //dd($areas);

        $post = new Post();
        $post->title = $request->title;

        $post->part_1 = $parts[0];
        $post->part_2 = $parts[1];
        $post->part_3 = $parts[2];
        $post->part_4 = $parts[3];
        $post->part_5 = $parts[4];
        $post->part_6 = $parts[5];
        $post->part_7 = $parts[6];
        $post->part_8 = $parts[7];

        $post->area_1 = $areas[0];
        $post->area_2 = $areas[1];
        $post->area_3 = $areas[2];
        $post->area_4 = $areas[3];
        $post->area_5 = $areas[4];

        $post->stance = $request->stance;
        $post->body = $request->body;
        $post->post_type = $request->post_type;

        Auth::user()->posts()->save($post);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        $postUser = User::find($post->user_id);

        return view('posts.show', ['post' => $post, 'postUser' => $postUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);

        $post_areas = [];
        $post_areas[] = $post->area_1;
        $post_areas[] = $post->area_2;
        $post_areas[] = $post->area_3;
        $post_areas[] = $post->area_4;
        $post_areas[] = $post->area_5;

        $post_parts = [];
        $post_parts[] = $post->part_1;
        $post_parts[] = $post->part_2;
        $post_parts[] = $post->part_3;
        $post_parts[] = $post->part_4;
        $post_parts[] = $post->part_5;
        $post_parts[] = $post->part_6;
        $post_parts[] = $post->part_7;
        $post_parts[] = $post->part_8;

        return view('posts.edit', ['post' => $post, 'post_parts' => $post_parts, 'post_areas' => $post_areas,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        //チェックされた数が上限未満であった場合、上限までnullを追加する処理
        $parts = $request->parts;
        $cnt_parts = count($parts);
        if($cnt_parts <= 7) {
            for($cnt_parts; $cnt_parts<=7; $cnt_parts++) {
                $parts[] = null;
            }
        }
        //チェックされた数が上限未満であった場合、上限までnullを追加する処理
        $areas = $request->areas;
        $cnt_areas = count($areas);
        if($cnt_areas <= 4) {
            for($cnt_areas; $cnt_areas<=4; $cnt_areas++) {
                $areas[] = null;
            }
        }

        $post = Post::find($id);

        $post->post_type = $request->post_type;
        $post->title = $request->title;

        $post->part_1 = $parts[0];
        $post->part_2 = $parts[1];
        $post->part_3 = $parts[2];
        $post->part_4 = $parts[3];
        $post->part_5 = $parts[4];
        $post->part_6 = $parts[5];
        $post->part_7 = $parts[6];
        $post->part_8 = $parts[7];

        $post->area_1 = $areas[0];
        $post->area_2 = $areas[1];
        $post->area_3 = $areas[2];
        $post->area_4 = $areas[3];
        $post->area_5 = $areas[4];

        $post->body = $request->body;

        Auth::user()->posts()->save($post);
        
        return $this->show($post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $user = Auth::user();

        if($post->user_id == $user->id) {
            $post->delete();
        }

        return redirect()->route('home');
    }

    public function search(SearchPostsRequest $request) {

        //$filters1
        //リクエストをもとにすべての投稿データの中から「post_type」と「stance」
        //が一致するものを抽出して格納した配列

        //$filters2
        //$filters1の結果から更にリクエストされた「parts」による絞り込みをかけた結果を
        //格納した配列

        //$results
        //$filters2の結果から更に「areas」による絞り込みをかけた結果を格納した配列


        $filters1 = Post::where('post_type', $request->post_type)
        ->where('stance', $request->stance)
        ->orderBy('updated_at', $request->order)
        ->orderBy('id', 'desc')
        ->get();

        if($filters1) {
            //選択されたパートを$partsに配列で渡す
            $parts = $request->parts;

            //選択された都道府県を$areasに配列で渡す
            $areas = $request->areas;

            //空の配列
            $filters2 = [];
            $results = [];
            
            //選択されたパートが1つでもあれば、それに該当するレコードを$filters1から取得して$filters2へ渡す
            //1つも選択されていなければ、$filters1のデータをそのまま$filters2へ渡す
            foreach($filters1 as $filter1) {
                if($parts) {
                    $cnt_parts = count($parts);
                    for($i=0; $i<$cnt_parts; $i++) {
                        if($filter1->part_1 == $parts[$i]) {
                            $filters2[] = $filter1;
                        } elseif($filter1->part_2 == $parts[$i]) {
                            $filters2[] = $filter1;
                        } elseif($filter1->part_3 == $parts[$i]) {
                            $filters2[] = $filter1;
                        } elseif($filter1->part_4 == $parts[$i]) {
                            $filters2[] = $filter1;
                        } elseif($filter1->part_5 == $parts[$i]) {
                            $filters2[] = $filter1;
                        } elseif($filter1->part_6 == $parts[$i]) {
                            $filters2[] = $filter1;
                        } elseif($filter1->part_7 == $parts[$i]) {
                            $filters2[] = $filter1;
                        } elseif($filter1->part_8 == $parts[$i]) {
                            $filters2[] = $filter1;
                        }
                    }
                } else {
                    $filters2[] = $filter1;
                }
            }

            //選択された都道府県が1つでもあれば、それに該当するレコードを$filters2から取得して$resultsへ渡す
            //1つも選択されていなければ、$filters2のデータをそのまま$resultsへ渡す
            foreach($filters2 as $filter2) {
                if($areas) {
                    $cnt_areas = count($areas);
                    for($i=0; $i<$cnt_areas; $i++) {
                        if($filter2->area_1 == $areas[$i]) {
                            $results[] = $filter2;
                        } elseif($filter2->area_2 == $areas[$i]) {
                            $results[] = $filter2;
                        } elseif($filter2->area_3 == $areas[$i]) {
                            $results[] = $filter2;
                        } elseif($filter2->area_4 == $areas[$i]) {
                            $results[] = $filter2;
                        } elseif($filter2->area_5 == $areas[$i]) {
                            $results[] = $filter2;
                        } 
                    }
                } else {
                    $results[] = $filter2;
                }
            }

            $results = array_unique($results);
        } else {
            $results = null;
        }

        return view('posts.search_results', ['results' => $results]);
    }

    public function write() {
        $user = Auth::user();
        $posts = Post::query()
            ->where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('posts.write', ['posts' => $posts]);
    }
}
