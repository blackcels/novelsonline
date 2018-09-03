<?php
/*
    ABSTRAIT A LA BILLETTERIE !!!
    Contrôleur utilisé pour instancier certaines entité pour tester
    le back-office /front.

 */
class TestController
{

    public function indexAction($param){
        $this->adminAction($param);
        $this->dataAction($param);
        $this->homeAction($param);
    }

    //Instanciation d'un administrateur pour tester le back-office
    public function adminAction($param){

        $admin = new AdminUserJson();
        $admin->setLogin("root");
        $admin->setPassword("root");
        $admin->setToken("");
        $admin->save();

        echo "admin ok";
    }

    public function dataAction($param){

        $data = new DatabaseJson();
        $data->setDbHost("localhost");
        $data->setDbName("Readersdb");
        $data->setDbPort("3306");
        $data->setDbUser("root");
        $data->setDbPwd("root");
        $data->save();

        echo "data ok";
    }

    public function homeAction($param){

        $home = new HomeJson();
        $home->setDescription("Lorem ipsum");
        $home->setLogoTitle("panda");
        $home->save();

        echo "data ok";
    }


}
