<?php

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();


$toggle_structure = '
<h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down" aria-hidden="true"></i>' . __('Logo',LOIN_CTRL_PLUGIN_DOMAIN) . '<i class="fa fa-times float_right" aria-hidden="true"></i></h3>
<div class="fs-submenu-box">
    <div class="inputcontainer">    
            <label for="titleLogo">Title</label><input type="text" spellcheck="false" name="titleLogo" id="titleLogo" placeholder="'. get_bloginfo( 'title', 'display' ) .'">
            <label for="logoLink">Link</label><input type="text" spellcheck="false" name="logoLink" id="logoLink"  placeholder="'. get_bloginfo( 'url' ) .'">  
      </div>
    
</div>

<h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down" aria-hidden="true"></i>' . __('Visibility options',LOIN_CTRL_PLUGIN_DOMAIN) . '</h3>
<div class="fs-submenu-box">
    <div class="switchcontainer">
        <div class="onofflabel">Hide the login error message</div>
        <div class="onoffswitch">
            <input type="checkbox" name="hideError" class="onoffswitch-checkbox" id="hideError"> <!-- checked -->
            <label class="onoffswitch-label" for="hideError">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>

        <div class="onofflabel">Hide “Remember Me” </div>
        <div class="onoffswitch">
            <input type="checkbox" name="removeRememberMe" class="onoffswitch-checkbox" id="removeRememberMe"> <!-- checked -->
            <label class="onoffswitch-label" for="removeRememberMe">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>

        <div class="onofflabel">Hide log in | Lost password link</div>
        <div class="onoffswitch">
            <input type="checkbox" name="removeLostPasswordLink" class="onoffswitch-checkbox" id="removeLostPasswordLink"> <!-- checked -->
            <label class="onoffswitch-label" for="removeLostPasswordLink">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
        
        <div class="onofflabel">Hide the “Back to” link</div>
        <div class="onoffswitch">
            <input type="checkbox" name="removeBackToLink" class="onoffswitch-checkbox" id="removeBackToLink"> <!-- checked -->
            <label class="onoffswitch-label" for="removeBackToLink">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>

        <div class="onofflabel">Remove the login page shake</div>
        <div class="onoffswitch">
            <input type="checkbox" name="removeShake" class="onoffswitch-checkbox" id="removeShake"> <!-- checked -->
            <label class="onoffswitch-label" for="removeShake">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>

        <div class="onofflabel">Set “Remember Me” to checked</div>
        <div class="onoffswitch">
            <input type="checkbox" name="rememberMe" class="onoffswitch-checkbox" id="rememberMe"> <!-- checked -->
            <label class="onoffswitch-label" for="rememberMe">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>

    </div>
</div>
<h3 class="fs-submenu not_selectable"><i class="fa fa-caret-down" aria-hidden="true"></i>' . __('Show to edit',LOIN_CTRL_PLUGIN_DOMAIN) . '</h3>
<div class="fs-submenu-box">
    <div class="switchcontainer">

        <div class="onofflabel messageError">Error message</div>
        <div class="onoffswitch messageError">
            <input type="checkbox" name="messageError" class="onoffswitch-checkbox" id="messageError"> <!-- checked -->
            <label class="onoffswitch-label" for="messageError">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>

        <div class="onofflabel">Message when disconnected</div>
        <div class="onoffswitch">
            <input type="checkbox" name="messageDisconnected" class="onoffswitch-checkbox" id="messageDisconnected"> <!-- checked -->
            <label class="onoffswitch-label" for="messageDisconnected">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>

        <div class="onofflabel">Log in Form</div>
        <div class="onoffswitch">
            <input type="checkbox" name="loginForm" class="onoffswitch-checkbox" id="loginForm"> <!-- checked -->
            <label class="onoffswitch-label" for="loginForm">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>

        <div class="onofflabel">Lost your password Form</div>
        <div class="onoffswitch">
            <input type="checkbox" name="LostPasswordForm" class="onoffswitch-checkbox" id="LostPasswordForm"> <!-- checked -->
            <label class="onoffswitch-label" for="LostPasswordForm">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>

        <div class="onofflabel">Register Form</div>
        <div class="onoffswitch">
            <input type="checkbox" name="registerForm" class="onoffswitch-checkbox" id="registerForm"> <!-- checked -->
            <label class="onoffswitch-label" for="registerForm">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
        
    </div>
</div>
';

	$toggle_array = array(
		'toggle_structure' => $toggle_structure
	);


?>