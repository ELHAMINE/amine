<?php
$user = null;
if(isset($_SESSION['user'])) {
    $user = json_decode($_SESSION['user']);
    $fullname = $user->nom . ' ' . $user->prenom;
}

if(!isset($fullname))
    $fullname = '';

$userConnected = [
    ['text' => $fullname, 'url' => '#'],
    ['text' => 'Sign out', 'url' => 'signout.php']
];

$userDisconnected = [
    ['text' => 'Sign in', 'url' => '../signin.php']
];

$horzItems = $user === null ? $userDisconnected : $userConnected;

if($user != null) {
    $vertItems = [
        ['text' => 'Modifier mes données', 'url' => 'profile.php'],
        ['text' => 'Consulter mes projets', 'url' => 'detailsprojects.php']
    ];
}
else {
    $vertItems = [];
}
?>
<nav>
    <ul>
        <li>
            <span id="openNav" class="link nav-icon">&#9776;</span>
        </li>
        <?php foreach ($horzItems as $value): ?>
            <li><a class="link" href="<?= $value['url'] ?>"><?= $value['text'] ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div id="vertNavBar" class="sidenav">
        <a id="closeNav" href="javascript:void(0)" class="closebtn">&times;</a>
        <?php foreach ($vertItems as $value): ?>
        <a class="link" href="<?= $value['url'] ?>"><?= $value['text'] ?></a>
        <?php endforeach; ?>
    </div>
</nav>