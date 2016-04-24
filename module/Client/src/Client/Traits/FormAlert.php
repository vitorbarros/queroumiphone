<?php
namespace Client\Traits;

trait FormAlert
{

    public function formatAlert(array $formMessages){
 
        $msg = null;
        foreach ($formMessages as $k => $v){
            foreach($v as $v2){

                if($k == 'csrf') {
                    $msg .= '<b>Sua seção expirou, atualize a página!</b><br />';
                }else{
                    $msg .= $v2.'<br />';
                }
  
            }
        }
        
        return $msg;
    }

}