<?php
namespace  Boutik\core\Validator;

class Validator {
    public array $errors=[];
    public function isEmpty(string $nameField, string $sms = "champ obligatoire")
{
    if (empty($_REQUEST[$nameField])) {
        $this->errors[$nameField]=$sms;
        return true;
    }
    return false;
}
 

public function validate( array $errors):bool
{
   return empty($errors);
}


public function isNumeric(string $nameField, string $sms = "saisir un nombre")
{
    if (is_numeric($_REQUEST[$nameField])) {
        return true;
    }
    $this->errors[$nameField]=$sms;
    return false;
}
public function isPositif(string $nameField, string $sms = "saisir un nombre positif")
{
    if (intval($_REQUEST[$nameField])>0) {
        return true;
    }
    $this->errors[$nameField]=$sms;
    return false;
}
public  function isEmail(string $inputField):bool{
    if(!filter_var($_REQUEST[$inputField],FILTER_VALIDATE_EMAIL)){
        $this->errors[$inputField]="Adresse email invalide";
        return true;
        }
        return false;
}

}