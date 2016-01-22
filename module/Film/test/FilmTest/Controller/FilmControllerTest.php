<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FilmTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class FilmControllerTest extends AbstractHttpControllerTestCase {

    public function setUp() {
        $this->setApplicationConfig(
                include '/wamp/www/ZendSkeletonApplication/config/application.config.php'
        );
        parent::setUp();
    }

    public function testIndexActionCanBeAccessed() {
        $this->dispatch('/film');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Film');
        $this->assertControllerName('Film\Controller\Film');
        $this->assertControllerClass('FilmController');
        $this->assertMatchedRouteName('film');
    }

}
