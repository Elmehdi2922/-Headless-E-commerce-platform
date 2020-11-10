<?php
namespace models;
use Ubiquity\orm\DAO;
class CatProd{
	/**
	 * @id
	 * @column("name"=>"id","nullable"=>false,"dbType"=>"int")
	 * @validator("id","constraints"=>array("autoinc"=>true))
	**/
	private $id;

	/**
	 * @column("name"=>"catalog","nullable"=>true,"dbType"=>"int")
	**/
	private $catalog;

	/**
	 * @column("name"=>"product","nullable"=>true,"dbType"=>"int")
	**/
	private $product;

	/**
	 * @column("name"=>"datecp","nullable"=>false,"dbType"=>"datetime")
	 * @validator("type","dateTime","constraints"=>array("notNull"=>true))
	**/
	private $datecp;

	 public function getId(){
		return $this->id;
	}

	 public function setId($id){
		$this->id=$id;
	}

	 public function getCatalog(){
		return $this->catalog;
	}

	 public function setCatalog($catalog){
		$this->catalog=$catalog;
	}

	 public function getProduct(){
		return $this->product;
	}

	 public function setProduct($product){
		$this->product=$product;
	}

	 public function getDatecp(){
		return $this->datecp;
	}

	 public function setDatecp($datecp){
		$this->datecp=$datecp;
	}

	 public function __toString(){
		return ($this->datecp??'no value').'';
	}
    public function addProdToCatalog(){
        if(DAO::insert($this))
            return true;
        else
            return false;
    }
    public function deleteCatProd($id){
        $cat= new CatProd;
        $cat=DAO::getOne(CatProd::class,$id);
        if(DAO::remove($cat))
            return true;
        else
            return false;
    }

}