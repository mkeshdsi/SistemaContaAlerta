<?php

class Cifras{

    private $texto;

    public function DecipherTexto($cipherText){
        $this -> texto = Decipher($cipherText, 3);
        return $this -> texto;
    }

    public function getTexto(){
        return $this -> texto;
    }

    public function setTexto($texto){
        $this -> texto =  $this->Encipher($texto, 3);
    }

    public function __construct($texto){
        $this->setTexto($texto);
    }


    private function Cipher($ch, $key)
    {
        if (!ctype_alpha($ch))
            return $ch;

        $offset = ord(ctype_upper($ch) ? 'A' : 'a');
        return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);
    }

    private function Encipher($input, $key)
    {
        $output = "";

        $inputArr = str_split($input);
        foreach ($inputArr as $ch)
            $output .=  $this->Cipher($ch, $key);

        return $output;
    }

    private function Decipher($input, $key)
    {
        return Encipher($input, 26 - $key);
    }

}
?>