<div class="topBar">
    <?php if($_SESSION['logged_user'] -> name): ?>
    <div class="userName" onclick="showUserArea();"><?php echo $_SESSION['logged_user'] -> name; ?></div>
    <?php elseif($_SESSION['logged_user'] -> login): ?>
    <div class="userName" onclick="showUserArea();"><?php echo $_SESSION['logged_user'] -> login; ?></div>
    <?php else: ?>
    <div class="userName" onclick="showUserArea();"><?php echo $_SESSION['logged_user'] -> email; ?></div>
    <?php endif; ?>
</div>

<div id="userNameModal" class="userNameModal hide">
    <ul>
        <li class=""><a href="settings.php">Настройки</a></li>
        <?php if($_SESSION['logged_user'] -> status == 'dev'): ?>
        <li><a href="addUser.php">Добавить пользователя</a></li>
        <?php endif; ?>
        <li><a href="logout.php">Выход</a></li>
    </ul>
</div>