<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/3/25
 * Time: 14:40
 */
namespace app\common\model;
use think\Model;

class Image extends Model{
    protected $hidden = ['delete_time', 'update_time'];//隐藏字段
    /**
     * hasOne 与 belongsTo 的区别
    一对一关系，存在主从关系（主表和从表 ），主表不包含外键，从表包含外键。
    hasOne 和 belongsTo 都是一对一关系，区别：
    在主表的模型中建立关联关系，用 hasOne
    在从表模型中建立关联关系，用 belongsTo
     * 建立与 Image 表的关联模型（一对一）
     * @return \think\model\relation\BelongsTo
     */
    public function items() {
        return $this->hasOne('BannerItem', 'img_id', 'id');
    }

    public static function getBannerByID($id)
    {
        //1
//        $banner = self::with(['items'])->find($id); // with 接收一个数组
        //2
        //根据关联表的查询条件查询  当前模型  的数据
//        $banner = self::hasWhere('items',['type'=>2])->find(); // with 接 收一个数组
//        return $banner;
        //3
        $user = Image::all(2); //get all 类似于select()
        $user = Image::get(2);
// 输出Profile关联模型的email属性
        return $user;
    }

}