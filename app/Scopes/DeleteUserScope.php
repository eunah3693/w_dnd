<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\DB;

class DeleteUserScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    // 탈퇴한 회원 포스트, 댓글 가지고 오지 않도록 적용
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereExists(function ($query) use ($model){
        $query->select(DB::raw(1))
            ->from('user_tbl')
            ->whereRaw($model->getTable().'.user_idx = user_tbl.idx')->where('user_tbl.status','!=','D');
        });
    }
}
