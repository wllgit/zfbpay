<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/3/25
 * Time: 14:19
 */
namespace app\common\model;
use think\Model;

class Banner extends Model{

    //建立与 Image 表的关联模型（一对多）
    public function items() {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    public static function getBannerByID($id)
    {
        $banner = self::with(['items', 'items.img'])->find($id); // with 接收一个数组  with 关联预载入
        return $banner;
    }



}