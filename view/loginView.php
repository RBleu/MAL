<?php

$pageTitle = 'Login - MAL';
$headerTitle = 'Login';
$style = 'loginSignup';

ob_start();

if(isset($errorMessage))
{
    ?>  
        <div id="error-message"><?= $errorMessage ?></div>
    <?php
}

?>


<div class="log-wrapper">
    <form action="index.php?a=login" class="log" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" class="field">
        <div class="password-header">
            <label for="password">Password</label>
            <div>
                <input type="checkbox" name="show-pass">
                <label for="show-pass">Show Password</label>
            </div>
        </div>
        <input type="password" name="password" class="field">
        <div>
            <input type="checkbox" name="stay-connect">
            <label for="stay-connect">Stay logged in ?</label>
        </div>
        <input class="btn log-btn" type="submit" value="Login">
        <div id="forgot">
            <a href="#" class="link">Forgot username ?</a>
            <a href="#" class="link">Forgot password ?</a>
        </div>
        <a id="redirect-link" class="log-btn" href="index.php?a=signup">Sign Up</a>
    </form>
</div>

<?php

$content = ob_get_clean();

require('view/template.php');
?>