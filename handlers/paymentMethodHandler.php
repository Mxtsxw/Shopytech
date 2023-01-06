<?php 
session_start();

// Si le formulaire est soumis
if(isset($_POST['paymentMethod']))
{
    // Vérifie que la variable existe
    if(isset($_POST['method']))
    {
        // Méthode de paiement par chèque
        if($_POST['method'] == 'cheque')
        {
            $method = 'cheque';
            $_SESSION['status'] = 1;
        }
        // Méthode de paiement par Paypal
        else if($_POST['method'] == 'paypal')
        {
            // redirect with session variable error
            $_SESSION['error_message'] = "La méthode de paiement par Paypal n'est pas encore disponible";
            header('Location: ../validation/payment');
            exit();
        }
    }
    else
    {
        // Par défaut la méthode de paiement est par chèque
        $method = 'cheque';
    }
}

// Redirection
header('Location: ../validation/confirmed');
exit();
    

?>