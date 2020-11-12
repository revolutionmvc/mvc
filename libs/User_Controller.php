<?php
/*
 * Use Only for Routes what access when only logged in
 * User Controller auth function match User id and login token on SESSION and
 * on database user table
 * Both of this values (SESSION and Database) update when login to that user
 */
class User_Controller extends Controller {
    
    function __construct($model_name) {
        parent::__construct($model_name);
        $this->auth();
//        $this->model->check_login_token();
        $this->view->user = $this->model->get_user(Hash::decrypt(Session::get(AUTH_PREFIX.'id')));
    }

    function auth() {
//        echo "auth called";
        if (Session::isset_session(AUTH_PREFIX.'id')) {
            $id = Hash::decrypt(Session::get(AUTH_PREFIX.'id'));
            $login_token = Hash::decrypt(Session::get(AUTH_PREFIX.'login_token'));
//            var_dump($login_token);
            if ($id != '' && $login_token != '' && !empty($login_token)) {
                $result = $this->model->check_login_token($id, $login_token);
                if (!empty($result)) {
                    return TRUE;
                } else {
                    header('Location: ' . URL_Admin);
                }
            }
        } else {
            header('Location: ' . URL_Admin);
        }
    }

//    function check_login_token($id, $login_token) {
////        $db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
//        $result = $this->db->select(array('table' => 'user', 'column' => '*', 'where' => 'id = :id and login_token = :token', 'data' => array('id' => $id, 'token' => $login_token)));
//        return $result;
//    }

}
