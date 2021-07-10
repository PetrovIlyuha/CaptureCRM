<?php


namespace App\Modules\Admin\Role\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

class PermissionsService
{
    public function save(Request $request, Model $model): bool {
//        $model->fill($request->only($model->getFillable()));
//        $model->save();
        return true;
    }
}
