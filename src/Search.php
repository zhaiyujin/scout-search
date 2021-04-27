<?php


namespace Zhaiyujin\ScoutSearch;
use Illuminate\Support\Facades\App;
use Zhaiyujin\ScoutSearch\EsSearch;

class Search
{
    use EsSearch;
    public $index="";
    public $indexs=1;
    public function searchType(){
        return "dfs_query_then_fetch";
    }
    //搜索索引
    public function index($index){
        if(is_array($index)){
            $string="";
            foreach ($index as $v){
                $string.= config('escout.prefix').App::make($v)->getTable().",";
            }
            $this->index=rtrim($string,",");

        }else {
            $this->index = $index;
        }

        return $this;
    }
    public function searchIndex(){
        return $this->index;
    }
    public function esearch($string){

        return $this->isearch($string,$this);

    }
    /**
     * Get the Scout engine for the model.
     *
     * @return mixed
     */
    public function searchableUsing()
    {
        return app(EngineManager::class)->engine();
    }
}
