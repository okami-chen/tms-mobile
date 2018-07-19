<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OkamiChen\TmsMobile\Controller;

use App\Http\Controllers\Controller;
use OkamiChen\TmsMobile\Entity\Mobile;

/**
 * Description of SearchController
 * @date 2018-7-19 18:53:50
 * @author dehua
 */
class SearchController extends Controller {
    
    /**
     * 手机号
     * @return type
     */
    public function mobile(){
        $q = request('q');
        $rows   = Mobile::where('mobile', 'like', "%$q%")
                ->paginate();
        logger($q);
        if(count($rows)){
            $items   = $rows->items();
        
            foreach ($items as $key => $item) {
                $item['text']   = $item['name'] . ' | ' .$item['mobile'];
            }
            $rows->setCollection(collect($items));            
        }
        return $rows;
    }
}
