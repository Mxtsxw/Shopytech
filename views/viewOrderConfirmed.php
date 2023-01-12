<?php $this->_t = 'Shopytech - Confirmation'; ?>

<div class="container my-4">
<div class="mt-5">
    <div class="mb-4 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
            fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </svg>
    </div>
    <div class="text-center">
        <h1>Nous vous remercions !</h1>
        <p>La facture de votre commande vous a été envoyé. Vous pouvez également télécharger la facture.</p> 
        <a href="<?=ROOT?>/validation/confirmed?download" type="submit" name="pdf" class="btn btn-primary">Télécharger la facture</a>
        <a href="<?=ROOT?>/" class="btn btn-primary">Retourner à l'accueuil</a>
    </div>
</div>
</div>