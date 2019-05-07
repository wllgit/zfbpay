<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/3/25
 * Time: 14:20
 */
namespace app\common\model;
use think\model;

class BannerItem extends Model{

//    protected $hidden = ['delete_time', 'update_time'];//隐藏字段
    /**
     * hasOne 与 belongsTo 的区别
    一对一关系，存在主从关系（主表和从表 ），主表不包含外键，从表包含外键。
    hasOne 和 belongsTo 都是一对一关系，区别：
    在主表的模型中建立关联关系，用 hasOne
    在从表模型中建立关联关系，用 belongsTo
     * 建立与 Image 表的关联模型（一对一）
     * @return \think\model\relation\BelongsTo
     */
//    public function img() {
//        return $this->belongsTo('Image', 'img_id', 'id')->field('id,url'); //关联模型名，外键名，关联模型的主键
//    }

}