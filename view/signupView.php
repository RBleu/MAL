<?php

$pageTitle = 'Sign Up - MAL';
$headerTitle = 'Sign Up';
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
    <form action="index.php?a=signup" class="log" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" class="field">
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
        <div class="password-header">
            <label for="confirm-password">Confirm Your Password</label>
            <div>
                <input type="checkbox" name="show-pass2">
                <label for="show-pass2">Show Password</label>
            </div>
        </div>
        <input type="password" name="confirm-password" class="field">
        <div>
            <input type="checkbox" name="agree">
            <label for="agree">I have read and agree to the <a href="#" class="link">Term of Service</a> and <a href="#" class="link">Privacy Policy</a></label>
        </div>
        <input class="btn log-btn" type="submit" value="Create Account">
    </form>
</div>

<?php

$content = ob_get_clean();

require('view/template.php');

?>