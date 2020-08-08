<?php 
include '../../includes/autoload.inc.php';

$amount = $_POST['amount'];//amount of users needed to be displayed

$userview = new Userview();

$result = $userview->getUsers($amount);

for ($i=0; $i < sizeof($result); $i++) { 
    $id = $result[$i]['id'];
    $fisrtname = $result[$i]['firstname'];
    $lastname = $result[$i]['lastname'];
    $email = $result[$i]['email'];
    echo "
        <tr>
            <td>$id</td>
            <td>$fisrtname</td>
            <td>$lastname</td>
            <td>$email</td>
        </tr>
    ";
}