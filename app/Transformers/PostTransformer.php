<?php

namespace Someline\Transformers;



use Someline\Models\Foundation\Post;

/**
 * Class PostTransformer
 * @package namespace Someline\Transformers;
 */
class PostTransformer extends BaseTransformer
{

    /**
     * Transform the Post entity
     * @param Post $model
     *
     * @return array
     */
    public function transform(Post $model)
    {
        return [
            'post_id' => (int) $model->post_id,
            'user_id' => (int) $model->user_id,
            /* place your other model properties here */
            'title' => (string) $model->title,
            'body' => (string) $model->body,
            'is_recommended' => (boolean) $model->is_recommended,
            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
