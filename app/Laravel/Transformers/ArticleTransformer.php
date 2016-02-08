<?php

namespace App\Laravel\Transformers;

class ArticleTransformer extends Transformer {

	public function transform($article)
    {
        return [
            'title' => $article['title'],
            'article' => $article['body'],
            'posted_by' => $article['created_by']
        ];
    }

}