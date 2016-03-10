<?php
// Analizar la información del evento en forma de json
$body = @file_get_contents('php://input');
$event_json = json_decode($body);

if ($event_json->type == 'charge.paid'){
 
 //Hacer algo con la información como actualizar los atributos de la orden en tu base de datos
 
 //charge = $this->Charge->find('first', array(
 
 //  'conditions' => array('Charge.id' => $event_json->object->id)
 
 //))
}

?>