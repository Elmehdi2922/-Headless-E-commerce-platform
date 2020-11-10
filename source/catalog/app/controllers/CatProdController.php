<?php
namespace controllers;

use models\CatProd;
use models\Product;
use Ubiquity\orm\DAO;

/**
 * Rest Controller CatProdController
 * @route("/rest/CatProds","inherited"=>true,"automated"=>true)
 * @rest("resource"=>"models\\CatProd")
 */
class CatProdController extends \Ubiquity\controllers\rest\RestController {

    /**
     * @route("/getAllProd","methods"=>["get"])
     */
    public function getAllProd()
    {
        $pro= new CatProd();

    }
    /**
     * @route("/deleteCatProd/{id}","methods"=>["delete"])
     */
    public function deleteCatProd($id)
    {
        if(CatProd::deleteCatProd($id))
            echo json_encode(["status"=>"OK 200","title"=>"CatProd deleted"]);
        else
            echo json_encode(["status"=>"OK 200","title"=>"Error deleting !"]);
    }
    /**
     * @route("/getbyCat/{cat}/Prod/{prod}","methods"=>["get"])
     */
    public function getbyCatProd($cat,$prod)
    {
        $cp=DAO::getAll(CatProd::class,"catalog = ".$cat." and product =".$prod);
        echo  $this->_getResponseFormatter()->get($cp);
    }

    /**
     * @route("/getbyCatalog/{cat}","methods"=>["get"])
     */
    public function getbyCatalog($cat)
    {
        $cp=DAO::getAll(CatProd::class,"catalog = ".$cat);
        $tableau=json_decode($this->_getResponseFormatter()->get($cp));
        $tabl= array();
        $tabl2= array();
        $inter='{"id":[]}';
        foreach($tableau->datas as $mydata)
        {array_push($tabl,$mydata->product);}
        $tabl2=array_unique($tabl);
        $sz=sizeof($tabl2);
        $cmpt=1;
        $inter='{"id":["0"]}';
        if($sz!=0)
        {
            $inter='{"id":["';
            foreach($tabl2 as $x)
            {
                if($cmpt<$sz)
                {
                    $inter=$inter. $x.'","';
                }else
                {
                    $inter=$inter. $x;
                }

                $cmpt=$cmpt+1;
            }
            $inter=$inter.'"]}';
        }
        echo $inter;
    }


}
