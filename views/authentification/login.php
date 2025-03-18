<?php $title="Se connecter" ?> 
<div data-w-id="df4cd933-feb9-dc4d-e842-84be2411378c" class="center-card">
    <!-- <a href="/" class="center-image w-inline-block">
        <img src="<?= SCRIPTS.'adminimg'.DIRECTORY_SEPARATOR.'hub.svg'?>" loading="lazy" width="122" alt=""/>
    </a> -->
    <div class="spacer _16"></div>
    <h2>Se connecter</h2>
    <p>Welcome back, it &#x27;s good to see you.</p>
    <div class="spacer _16"></div>
    <div class="w-form">
        <form id="email-form" name="email-form" data-name="Email Form" redirect="/profile" data-redirect="/profile" class="sign-up-form">
            <label for="Subscriber-Email-3" class="field-label">Email</label>
            <input type="email" class="simple-input no-margin w-input" maxlength="256" name="Subscriber-Email" placeholder="name@company.com" required/>
            <div class="spacer _16"></div>
            <label for="Subscriber-Password" class="field-label">Mot de passe</label>
            <input type="password" class="simple-input no-margin w-input" maxlength="256" name="Subscriber-Password" placeholder="***********" required/>
            <div class="spacer _24"></div>
            <input type="submit" value="Se connecter" class="button no-margin w-button"/>
        </form>
        <!-- <div class="form-success w-form-done">
            <div>Thank you! Your submission has been received!</div>
        </div>
        <div class="w-form-fail">
            <div>Oops! Something went wrong while submitting the form.</div>
        </div> -->
    </div>
    <p class="paragraph-small">
        Mot de passe oublié? <a href="/pages/password-reset" class="simple-link">Cliquez ici</a>
        .
    </p>
</div>