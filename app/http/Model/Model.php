<?php

namespace App\http\Model;

use PDO;

abstract class Model 
{
   protected $db;
   protected $table;

   public function __construct($db)
   {
        $this->db = $db;
   }
   
   public function all()
   {
       return $this->query("SELECT * FROM {$this->table} ORDER BY create_at DESC");
   }

   public function findById($id)
   {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
   }

   public function destroy(int $id)
   {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id]);
   }

   public function create(array $data, $relation = null)
   {
          $i = 1;
          $firstParentHesis = "";
          $secondParentHesis = "";

          foreach ($data as $key => $value) {
               
               $comma = $i === count($data) ? "" : ", ";
               $firstParentHesis .= "{$key}{$comma}";
               $secondParentHesis .= ":{$key}{$comma}";
               $i++;

          }

          return $this->query("INSERT INTO {$this->table} ($firstParentHesis) VALUES ($secondParentHesis)", $data); 

   }

   public function update(int $id, array $data, ?array $relation = null)
   {
     $sqlRequestPart = "";
     $i = 1;

     foreach ($data as $key => $value) {

          $comma = $i === count($data) ? "" : ", ";
          $sqlRequestPart .= "{$key} = :{$key}{$comma}";
          $i++;
          
     }
     $data['id'] = $id;
     return $this->query("UPDATE {$this->table} SET {$sqlRequestPart} WHERE id = :id", $data);

   }
   
   /**
    * Refactorise
    */

   public function query($qsl, array $params = null, bool $single = null)
   {
     $method = is_null($params) ? "query" : "prepare";

     if(
        strpos($qsl, "DELETE") === 0 || 
        strpos($qsl, "UPDATE") === 0 || 
        strpos($qsl, "INSERT") === 0
     ){
          $stmt = $this->db->$method($qsl);
          $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]); 
          return $stmt->execute($params);
     }

     $fetch = is_null($single) ? "fetchAll" : "fetch";

     $stmt = $this->db->$method($qsl);
     $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

     if($method === 'query'){
          return $stmt->$fetch();
     }else{
          $stmt->execute($params);
          return $stmt->$fetch();
     }
   }

}
