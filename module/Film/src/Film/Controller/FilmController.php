<?php

namespace Film\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Film\Model\Film;          // <-- Add this import
 use Film\Form\FilmForm;       // <-- Add this import


 class FilmController extends AbstractActionController
 {
     
     protected $filmTable;
    

     public function addAction()
     {
         $form = new FilmForm();
         $form->get('submit')->setValue('Ajouter');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $film = new Film();
             $form->setInputFilter($film->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $film->exchangeArray($form->getData());
                 $this->getFilmTable()->saveFilm($film);

                 // Redirect to list of films
                 return $this->redirect()->toRoute('film');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('film', array(
                 'action' => 'add'
             ));
         }

         // Get the Film with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $film = $this->getFilmTable()->getFilm($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('film', array(
                 'action' => 'index'
             ));
         }

         $form  = new FilmForm();
         $form->bind($film);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($film->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getFilmTable()->saveFilm($film);

                 // Redirect to list of films
                 return $this->redirect()->toRoute('film');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
     }

     public function deleteAction()
     {
         
         
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('film');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getFilmTable()->deleteFilm($id);
             }

             // Redirect to list of films
             return $this->redirect()->toRoute('film');
         }

         return array(
             'id'    => $id,
             'film' => $this->getFilmTable()->getFilm($id)
         );
     }
     
     public function getFilmTable()
     {
         if (!$this->filmTable) {
             $sm = $this->getServiceLocator();
             $this->filmTable = $sm->get('Film\Model\FilmTable');
         }
         return $this->filmTable;
     }
     
     public function indexAction()
     {
         
         
         return new ViewModel(array(
             'films' => $this->getFilmTable()->fetchAll(),
             
         ));
     }
     
     
 }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

