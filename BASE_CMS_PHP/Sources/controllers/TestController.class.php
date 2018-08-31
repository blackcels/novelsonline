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
    }

    //Instanciation d'un administrateur pour tester le back-office
    public function adminAction($param){

        $admin = new AdminUserJson();
        $admin->setIdentifiant("admin");
        $admin->setPassword("admin");
        $admin->setAdmin(true);
        $admin->setCompany("GoOut");
        $admin->setAddress("faubourg saint antoine");
        $admin->setZipcode(75012);
        $admin->setCity("Paris");
        $admin->setCountry("France");
        $admin->setCompanyType("Association");
        $admin->setSiret("0235334SDFGSDZ546234234245T34G6356G5");
        $admin->setHostName("OVH");
        $admin->setHostIpAddress("www.ovh.com");
        $admin->setEmail("contact.goout@gmail.com");
        $admin->setLastname("M_J_N");
        $admin->setFirstname("TR_LO_NE");
        $admin->save();

        echo "admin ok";
    }

    //Envoie d'un mail
    public function sendmailAction($param){
        $option = [
            "subject" => "twitch",
            "data" =>[
                "{name}" => "toto",
                "{channel}" => "Yadrim"
            ]
        ];

        echo Mailer::send("tit-max@live.fr", "test_template_mail", $option);
    }

}
