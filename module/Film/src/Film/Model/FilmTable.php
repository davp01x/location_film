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

     public function fetchAll($user)
     {
        /*$resultSet = $this->tableGateway->select();
        return $resultSet;*/
         $id =  $user;
         $select = new Select();
         $select->from(array('a' => 'film'));
         $select->join(array('u' => 'users') ,'a.user_id = u.id');         // join expression
         $select->where('a.user_id = "' . $id . '";');
         
         $resultSet = $this->tableGateway->selectWith($select);
         return $resultSet;
     }
     
     public function getFilmByUser($user) {
        // $this->isMine();
        $id = (int) $user->id;
        $rowset = $this->tableGateway->select(array('user_id' => $id));
        
         if (!$rowset) {
          throw new \Exception("Could not find row $id");
          } 
        return $rowset;
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

