<?php 

namespace app\api\validate;

class IDCollection extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|checkIDs'
    ];

    protected $message = [
        'ids' => 'ids参数必须为以逗号分隔的多个正整数,仔细看文档啊'
    ];

    protected function checkIDs($value)
    {
        $values = explode(',', $value);
        if (empty($values)) {
            return false;
        }
        foreach ($values as $id) {
            if (!$this->isPositiveInteger($id)) {
                // 必须是正整数
                return false;
            }
        }
        return true;
    }

    protected function checkIDs1($value, $rule, $data)
    {
        $result = true;
        $values = explode(',', $value);
        if (empty($values)) {
            $result = false;
        }
        array_walk($values, function ($id) use (&$result) {
            if (!$this->isPositiveInteger($id)) {
                // 必须是正整数
                $result = false;
            }
        });
        return $result;
    }



}