<?php

namespace ecommerce;

use Rain\Tpl;

class Page{

    private $tpl;
    private $options = [];
    private $defalts = [
        "header"=>true,
        "footer"=>true,
        "data"=>[]
    ];

    public function __construct($opts = array(), $tpl_dir = "/views/"){

        # Vai fazer um merge nas duas variáveis, e caso $opts tenha dados a mais que e/ou diferentes do defalts
        # ele pode sobrescreve-lo.
        $this->options = array_merge($this->defalts, $opts);

        # Condiguração padrão do TPL
        $config = array(
            "tpl_dir"=> $_SERVER["DOCUMENT_ROOT"]. $tpl_dir,
            "cache_dir" => $_SERVER["DOCUMENT_ROOT"]."/views-cache/"
        );

        # Atribuindo a configuração estabelecida por padrão
        Tpl::configure($config);

        $this->tpl = new Tpl;

        # Essa função vai atribuir todas as configurações para o objeto tpl 
        $this->setData($this->options["data"]);

        # Arquivo a ser requisitado
        # Tem que verificar antes, se a pagina a ser exibida tem o header padrão
        if ($this->options["header"] === true){
            $this->tpl->draw("header");
        }
    }

    public function setTpl($name, $data = array(), $returnHTML = false){
        $this->setData($data);
        return $this->tpl->draw($name, $returnHTML);
    }

    private function setData($data = array()){
        foreach ($data as $key => $value){
            $this->tpl->assign($key, $value);
        }
    }

    public function __destruct()
    {
        # Arquivo a ser requisitado
        # Tem que verificar antes, se a pagina a ser exibida tem o header padrão
        if ($this->options["footer"] === true){
            $this->tpl->draw("footer");
        }
    }



}

?>
