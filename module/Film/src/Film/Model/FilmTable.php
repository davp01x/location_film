<?php

namespace Film\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Select;

 class FilmTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
         
     }


     public function getFilm($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveFilm(Film $film)
     {
         $data = array(
             'realisateur' => $film->realisateur,
             'title'  => $film->title,
             'categorie' => $film->categorie,
             'acteur' => $film->acteur,
             'prix_location' => $film->prix_location,
         );

         $id = (int) $film->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getFilm($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Film id does not exist');
             }
         }
     }

     public function deleteFilm($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

