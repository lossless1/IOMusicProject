<?php
session_start();
require_once(__DIR__ . '/page_public.php');
require_once(__DIR__ . '/rb.php');

class FacebookLogin extends page_public
{
    public function FaceBookLogin()
    {
        $client_id = '1584915008495879'; // Client ID
        $client_secret = 'e0cd161a7174f003cd49e931d533bd0c'; // Client secret
        $redirect_uri = 'http://localhost:8080/IOMusicProject/app/php/facebook_login.php'; // Redirect URIs
        $tokenInfo = null;
        $result = false;
        $url = 'https://www.facebook.com/dialog/oauth';

        $params = array(
            'client_id' => $client_id,
            'redirect_uri' => $redirect_uri,
            'response_type' => 'code',
            'scope' => 'email,user_birthday'
        );
        //if (empty($_GET['code'])) {
            echo $link = '<p><a href = "' . $url . '?' . urldecode(http_build_query($params)) . '"><img src="./app/images/facebook_login.png"></a></p>';
        //}

        if (isset($_GET['code'])) {
            $result = false;

            $params = array(
                'client_id' => $client_id,
                'redirect_uri' => $redirect_uri,
                'client_secret' => $client_secret,
                'code' => $_GET['code']
            );

            $url = 'https://graph.facebook.com/oauth/access_token';


            parse_str(file_get_contents($url . '?' . urldecode(http_build_query($params))), $tokenInfo);
        }
        $userInfo = null;
        if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
            $params = array('access_token' => $tokenInfo['access_token']);

            $userInfo = json_decode(file_get_contents('https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params))), true);
            if (isset($userInfo['id'])) {
                $result = true;
            }
        }

        if ($result) {
            $username = $userInfo['name'];
            $_SESSION['username'] = $userInfo['name'];
            $this->ConnectDB();

            $checkuser = R::findOne('users','user_login = ?',[$username]);
            if(!$checkuser){
                $users = R::dispense('users');
                $users['user_login'] = $userInfo['name'];
                $users['user_password'] = null;
                $users['user_email'] = $userInfo['email'];
                $users['user_gender'] = $userInfo['gender'];
                $users['user_birthday'] = $userInfo['birthday'];
                $users['user_googleid'] = $userInfo['id'];
                $users['user_link_to_profile'] = $userInfo['link'];
                R::store($users);
                header("Location: http://localhost:8080/IOMusicProject/app/php/page_search_public.php");
            }else{
                header("Location: http://localhost:8080/IOMusicProject/app/php/page_search_public.php");
            }


            //echo "Здравствуйте ".$userInfo['name'].". Вы выполнили вход!<br>";
            //$this->setInterval(function(){

            //},3000);
            //var_dump($_SESSION);
            //echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
            //echo "Имя пользователя: " . $userInfo['name'] . '<br />';
            //echo "Email: " . $userInfo['email'] . '<br />';
            //echo "Ссылка на профиль пользователя: " . $userInfo['link'] . '<br />';
            //echo "Пол пользователя: " . $userInfo['gender'] . '<br />';
            //echo "ДР: " . $userInfo['birthday'] . '<br />';
            //echo '<img src="http://graph.facebook.com/' . $userInfo['id'] . '/picture?type=large" />'; echo "<br />";

        }
    }
}

$facebook = new FacebookLogin();
?>

