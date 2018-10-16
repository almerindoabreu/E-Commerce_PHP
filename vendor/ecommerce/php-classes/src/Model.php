<?php 

namespace ecommerce;

class Model{

    private $value = [];

    # Objeto para gerar os Geters e Setters
    public function __call($name, $args){
        # Essa função vai pegar apenas os 3 primeiros digitos
        $method = substr($name, 0, 3);
        # Final do nome do método
        $fieldName = substr($name, 3, strlen($name));

        switch ($method){
            case "get":
                return $this->values[$fieldName];
            break;
            case "set":
                $this->values[$fieldName] = $args[0];
            break;
        }
    }

    public function setData($data){
        
        foreach ($data as $key => $value){
            $this->{"set".$key}($value);
        }
    }

    public function getValues(){
        return $this->values;
    }
}



?>