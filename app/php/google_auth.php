<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/IOMusicProject/app/php/page_public.php');
class GoogleAutorization extends page_public
{
    public function GoogleAutorization()
    {

        $client_id = '88350789731-urmn6l00cblkci4fo687t91gk9knt4qn.apps.googleusercontent.com'; // Client ID
        $client_secret = 'AYwlkPsamDTnst_AxiXPcUuT'; // Client secret
        $redirect_uri = 'http://localhost:8080/IOMusicProject/app/php/google_auth.php'; // Redirect URI

        $result = null;

        $url = 'https://accounts.google.com/o/oauth2/v2/auth';

        $params = array(
            'redirect_uri' => $redirect_uri,
            'response_type' => 'code',
            'client_id' => $client_id,
            'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
        );

        echo $link = '<p><a src="./app/images/facebook_login.png" href="' . $url . '?' . urldecode(http_build_query($params)) . '"><img src="./app/images/facebook_login.png"></a></p>';

        // https://accounts.google.com/o/oauth2/auth?redirect_uri=http://localhost/google-auth&response_type=code&client_id=333937315318-fhpi4i6cp36vp43b7tvipaha7qb48j3r.apps.googleusercontent.com&scope=https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile
        if (!empty($_GET['code'])) {

            $params = array(
                'code' => $_GET['code'],
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'redirect_uri' => $redirect_uri,
                'grant_type' => 'authorization_code'
            );
            $url = 'https://www.googleapis.com/oauth2/v4/token';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);


            $tokenInfo = json_decode($result, true);

            if (!empty($tokenInfo['access_token'])) {
                $params['access_token'] = $tokenInfo['access_token'];
                $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
                if (!empty($userInfo['id'])) {

                    $result = true;
                    if ($result) {
                        //echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
                        ///echo "Имя пользователя: " . $userInfo['name'] . '<br />';
                        $_SESSION['username'] = $userInfo['name'];
                        header("Location: http://localhost:8080/IOMusicProject/app/php/page_search_public.php");
                        ///var_dump([$_SESSION]);
                        //echo "Email: " . $userInfo['email'] . '<br />';
                        //echo "Ссылка на профиль пользователя: " . $userInfo['link'] . '<br />';
                        //echo "Пол пользователя: " . $userInfo['gender'] . '<br />';
                        //echo '<img src="' . $userInfo['picture'] . '" />'; echo "<br />";
                    }
                }
            }
        }

    }

}

$google = new GoogleAutorization();
?>