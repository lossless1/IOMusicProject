<?php
require_once(__DIR__ . '/page_public.php');

class registration_form extends page_public
{
    protected function Content()
    {
        ?>
        <table border="0" align="center">
            <tbody>
            <tr>
                <td align="center">
                    <h3>Регистрация пользователя</h3>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            </tbody>
        </table>
        <form action="./registration.php" method="post">
            <table border="0" align="center">
                <tbody>
                <tr>
                    <td align="right" width="1">Логин</td>
                    <td width="1"><input name="user_login" size="40" type="text"/></td>
                </tr>
                <tr>
                    <td align="right">Пароль</td>
                    <td><input name="user_passwd" size="40" type="password"/></td>
                </tr>
                <tr>
                    <td align="right">Подтверждение пароля</td>
                    <td><input name="user_passwd2" size="40" type="password"/></td>
                </tr>
                <tr>
                    <td align="right">E-mail</td>
                    <td><input name="user_email" size="40" type="text"/></td>
                </tr>
                <tr>
                    <td align="right">Имя</td>
                    <td><input name="user_name" size="40" type="text"/></td>
                </tr>
                <tr>
                    <td align="right">Город</td>
                    <td><input name="user_city" size="40" type="text"/></td>
                </tr>
                <tr>
                    <td align="right">Телефон</td>
                    <td><input name="user_phone" size="40" type="text"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td  colspan="2" align="center"><input type="submit" value="Зарегистрироваться"/></td>
                </tr>
                </tbody>
            </table>
        </form>

        <?php
    }
}
$page = new registration_form();
$page->DisplayPage();
?>