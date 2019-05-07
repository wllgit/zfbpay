<?php
namespace app\common\model;
use think\Model;
use think\DB;
use app\common\model\Column;
/**
 * @ClassName:    Name 
 * @Description:  Detail 
 * @Created by:   [villager] 
 * @DateTime:     2018-05-28T14:15:10+0800
 */
Class Test extends Model
{
    protected $start = 0; //查询起始位置
    protected $offset = 10;   //查询条数
    protected $where; //查询条件
    protected $self_field = '*'; //查询字段
    protected $order = 'id desc'; //排序字段
	use \app\common\traits\Head;


    public function findColumns($model,$value) {
        if($value['parent_id'] != 0) {
            $where = ['id' => $value['parent_id']];
            $field = 'id,username'; // 栏目标题
            $query = compact('field','where');
            $value = $model->index('columnInfo',$query);
        }
        return $value;
    }




}