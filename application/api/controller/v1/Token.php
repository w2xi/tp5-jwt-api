<?php

namespace app\api\controller\v1;

use app\api\exception\JwtTokenMissingException;
use app\api\exception\NeedPermissionException;
use app\api\service\JwtAuth;

class Token
{
    public function refresh()
    {
        $token = request()->header('Authorization');
        if (!$token) {
            throw new JwtTokenMissingException();
        }
        $instance = JwtAuth::instance();
        $instance->setToken($token)->refreshValidate();
        $user = UserModel::get($instance->getUid());
        if (!$user) {
            throw new NeedPermissionException();
        }

        return _success(['token' => $instance->getToken()]);
    }
}
