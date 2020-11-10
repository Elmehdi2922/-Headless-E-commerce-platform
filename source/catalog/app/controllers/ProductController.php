<?php
namespace controllers;

use models\Catalog;
use models\CatProd;
use models\Product;
use Ubiquity\orm\DAO;

/**
 * Rest Controller ProductController
 * @route("/rest/products","inherited"=>true,"automated"=>true)
 * @rest("resource"=>"models\\Product")
 */
class ProductController extends \Ubiquity\controllers\rest\RestController {

    /**
     * @route("/getAllProd","methods"=>["get"])
     */
    public function getAllProd()
    {
        $pro= new Product();
        $pr=$pro->getAllProd();
        echo $this->_getResponseFormatter()->get($pr);
    }
    /**
     * @route("/getById/{id}","methods"=>["get"])
     */
    public function getById($id)
    {
        $pro= new Product();
        $pr=$pro->getByID($id);
        echo $pr;
    }

    /**
     * @param string cat
     * @route("/getProdsbyCatalog/{cat}","methods"=>["get"])
     */
    public function getProdsbyCatalog($cat)
    {
        $cp=DAO::getAll(Product::class,"id in(".$cat.")");
        //$cp=DAO::getAll(Product::class,"id in(1,2,3,4)");
        echo $this->_getResponseFormatter()->get($cp);

        //echo CatProd;
       /* $pro= new Product();
        $pr=DAO::getAll(Product::class,"id in (1,2,4,5,9,6,12)",false);


        echo $this->_getResponseFormatter()->get($pr);
        //return json_encode(["title"=>$pr]);
       /* $pro= new Product();
        echo $pro->getProdsbyCatalog();*/
    }

}
