<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/3/25
 * Time: 11:08
 */
namespace app\common\model;
use think\Model;

class Users extends Model{
    protected $start = 0; //查询起始位置
    protected $offset = 100;   //查询条数
    protected $where; //查询条件
    protected $whereOr = false; //查询条件
    protected $self_field = '*'; //查询字段
    protected $order = 'id desc'; //排序字段
    protected $autoWriteTimestamp = true;//自动写入时间戳
    use \app\common\traits\Head;


    private function columnInfo() {
        $info = $this -> get(function($query){
            $query -> where($this->where) -> field($this->self_field);
        });
        return $info;
    }

    //多对多
    public function roles()
    {
        return $this->belongsToMany('Role','role_user','users_id');
    }

    public static function info(){
        $info = self::with('roles')->select();
        return $info;
    }
}