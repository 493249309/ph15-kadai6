<?php

function saveUser(array $user):array
{
    $handle = fopen(__DIR__ . '/../date/users.csv','a');

    $user['id'] = getNewId();

    fputcsv($handle, [
        $user['id'],
        $user['name'],
        $user['email'],
        password_hash($user['password'], PASSWORD_DEFAULT),
        $user['birth'],
        $user['telephone'],
        $user['address'],
    ]);

    fclose($handle);

    return $user;
}

function getUsers():array
{
    $handle = fopen(__DIR__ . '/../date/users.csv','r');
    $users = [];

    while (!feof($handle)){
        $row = fgetcsv($handle);

        if ($row === false || is_null($row[0])){
            break;
        }

        $user = [
            'id' => $row[0],
            'name' => $row[1],
            'email' => $row[2],
            'password' => $row[3],
            'birth' => $row[4],
            'telephone' => $row[5],
            'address' => $row[6],
        ];

        $users[] = $user;
    }
    fclose($handle);

    return $users;
}

function getNewId():int
{
    $maxId = 0;
    $users = getUsers();


    foreach ($users as $user) {
        $id = intval($user['id']);
        if ($id > $maxId) {
            $maxId = $id;
        }
    }
    return $maxId + 1;
}
function login(string $email, string $password): ?array
{
    $users =getUsers();

    foreach ($users as $user){
        if ($user['email'] === $email && password_verify($password, $user['password'])){
        return $user;
    }
}
return null;
}

function getUser(string|int $id): ?array
{
    $users = getUsers();

    foreach ($users as $user) {
        if (intval($user['id']) === intval($id)) {
            return $user;
        }
    }

    return null;
}

function editUser(array $user):void
{
    $users = getUsers();

    $handle = fopen(__DIR__ . '/../date/users.csv', 'w');

    foreach ($users as $u) {
        if (intval($user['id']) === intval($u['id'])) {
            $u = [
                $user['id'],
                $user['name'],
                $user['email'],
                password_hash($user['password'],PASSWORD_DEFAULT),
                $user['birth'],
                $user['telephone'],
                $user['address'],
            ];
        }

        fputcsv($handle, $u);
    }

    fclose($handle);
}
