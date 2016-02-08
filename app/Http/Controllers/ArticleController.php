<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Laravel\Transformers\ArticleTransformer;
use Input;

class ArticleController extends APIController
{
    protected $articleTransformer;

    function __construct(ArticleTransformer $articleTransformer)
    {
        $this->articleTransformer = $articleTransformer;

        $this->middleware('auth.basic', ['only' => 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = \Input::get('limit') ?: 7;

        $articles = Article::paginate($limit);

        //dd(get_class_methods($articles));

        return $this->responseWithPagination($articles, [
            'data' => $this->articleTransformer->transformCollection($articles->all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Input::get('title') or !Input::get('body'))
        {
            return $this->respondValidationFailed('Parameters failed validation for a article.');
        }

        Article::create(Input::all());

        return $this->responseCreated('Article successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        if(!$article) {
            return $this->respondNotFound('Article does not exist.');
        }

        return $this->respond([
            'data' => $this->articleTransformer->transform($article)
        ]);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }

}
