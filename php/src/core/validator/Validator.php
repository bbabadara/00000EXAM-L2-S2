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

public function verifNumber($n):bool{
    return is_numeric($n);
}

}