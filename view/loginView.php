<?php

$pageTitle = 'Login - MAL';
$headerTitle = 'Login';
$styles = ['loginSignup'];
$scripts = ['loginSignup'];

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
        <input type="text" name="username" class="field" minlength="4" maxlength="20" pattern="^[\w]{4,20}$">
        <div class="password-header">
            <label for="password">Password</label>
            <div>
                <input class="show-pass" type="checkbox" name="show-pass">
                <label for="show-pass">Show Password</label>
            </div>
        </div>
        <input type="password" name="password" class="field" minlength="8" maxlength="50" pattern="^.{8,50}$">
        <div>
            <input type="checkbox" name="stay-connect">
            <label for="stay-connect">Stay logged in ?</label>
        </div>
        <input class="btn log-btn" type="button" value="Login">
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