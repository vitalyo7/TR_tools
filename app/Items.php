<?php

//! Front-end processor
class Items extends Controller {

    function getItemResult($f3, $filters) {
      $db = $this->getWorldDb();

      $page = 1;
      if(isset($filters['page']) && !empty($filters['page'])) {
        $page = $filters['page'];
      }
      
      $start_index = ($page - 1) * 50;

      $sql = <<<EOD
        select 
          it.itemTemplateId as itemTemplateId,	
          it.itemClassId    as itemClassId,
          en.className      as className,
          en.augList        as augList
        from 
          itemtemplate_itemclass it
          join entityclass en on it.itemClassId = en.classId
        order by
          en.className
        limit 
          $start_index,50
      EOD;
        
      $max_count_sql = <<<EOD
        select 
          count(*) as max_count
        from
          itemtemplate_itemclass it
          join entityclass en on it.itemClassId = en.classId
      EOD;

      $result = $db->exec($sql);
      $max_count = ceil($db->exec( $max_count_sql)[0]['max_count'] / 50);

      $this->addMoreInformation($f3,$db,$result);
      
      $rs = array();
      $rs['data']      = $result;
      $rs['page']      = $page;
      $rs['pageMax']   = $max_count;
      return $rs;
    }

    function addMoreInformation($f3, $db, &$rs) {
      

      $inv_info_sql = <<<EOD
        SELECT 
          *
        FROM 
          `itemclass` iclass 
          left join gui_item_icons icons on iclass.inventoryIconStringId = icons.iconId WHERE iclass.classId = :classId;
      EOD;

      $baseIconImgUrl = $f3->get("BASE")."/img/item_icons/";

      foreach ($rs as &$item) {
        $item['icon'] = $baseIconImgUrl."ui_ico_item_unknown.png";
        $lookup = $db->exec($inv_info_sql, array(':classId'=> $item["itemClassId"]));
        if(!empty($lookup) && !empty($lookup[0]["iconFile"])) {
          $item['icon'] = $baseIconImgUrl.$lookup[0]["iconFile"];
        }
      }

    }

    function mainPage($f3, $args) {
      $filters = array();
      if($f3->exists("GET.page")) {
        $filters['page'] = $f3->get("GET.page");
      }

      $rs = $this->getItemResult($f3,$filters);

      $f3->set('rs', $rs);
		  $f3->set('content','item_list.htm');
      echo "<pre>";
      echo var_dump($rs);
      echo "</pre>";
		  echo  \Template::instance()->render('layout.htm');

    }
}
?>