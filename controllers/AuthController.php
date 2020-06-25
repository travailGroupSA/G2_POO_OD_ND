<?php
class AuthController extends Controller
{

    public function login()
    {
        if (isset($_POST['connecter'])) {
            extract($_POST);
            Validations::isEmpty($login, "login", "Le Login est vide");
            Validations::isEmpty($password, "password", "Le Mot de Passe est vide");
            if (Validations::isValid()) {
                $admin = new AdminManager();
                $this->adminExist = $admin->findByLoginAndPwd($login, $password);
                if ($this->adminExist != null) {
                    $this->layout = "admin";
                    Sessions::set("admin", $this->adminExist);
                    $this->redirect('etudiant/index');
                } else {
                    //User Not Existe
                    $this->errors = ["error" => "Login Mot de Passe Incorrect"];
                }
            } else {
                //champs Vide
                $this->errors = ["error" => "Veuillez remplire tous les champs"];

                die();
                $this->view("auth/login",  $this->errors);
            }
        }
        $this->view('auth/login');
    }

    public function logout()
    {
        Sessions::destroy();
        $this->redirect($this->login());
    }
}