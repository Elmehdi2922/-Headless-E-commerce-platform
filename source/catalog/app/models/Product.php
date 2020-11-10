<?php
namespace models;
use Ubiquity\orm\DAO;

use Ubiquity\utils\http\URequest;
class Product{
	/**
	 * @id
	 * @column("name"=>"id","nullable"=>false,"dbType"=>"int")
	 * @validator("id","constraints"=>array("autoinc"=>true))
	**/
	private $id;

	/**
	 * @column("name"=>"lib","nullable"=>false,"dbType"=>"varchar(200)")
	 * @validator("length","constraints"=>array("max"=>200,"notNull"=>true))
	**/
	private $lib;

	/**
	 * @column("name"=>"image","nullable"=>false,"dbType"=>"varchar(250)")
	 * @validator("length","constraints"=>array("max"=>250,"notNull"=>true))
	**/
	private $image;

	/**
	 * @oneToMany("mappedBy"=>"product","className"=>"models\\CatalogProduct")
	**/
	private $catalogProducts;

	 public function getId(){
		return $this->id;
	}

	 public function setId($id){
		$this->id=$id;
	}

	 public function getLib(){
		return $this->lib;
	}

	 public function setLib($lib){
		$this->lib=$lib;
	}

	 public function getImage(){
		return $this->image;
	}

	 public function setImage($image){
		$this->image=$image;
	}

	 public function getCatalogProducts(){
		return $this->catalogProducts;
	}

	 public function setCatalogProducts($catalogProducts){
		$this->catalogProducts=$catalogProducts;
	}

	 public function __toString(){
		return ($this->image??'no value').'';
	}
    public function getProdsbyCatalog(){
        $pro= new Product();
        $pr=DAO::getAll(Product::class,"id in (1,2,4,5,9,6,12)",false);
        return $this->_getResponseFormatter()->get($pr);
    }

}