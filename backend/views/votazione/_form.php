<?php
$type = $type??"create";


if($type == "create"){
    echo $this->render('_formCreate', [
        'votazione' => $votazione,
    ]);
}else{
    echo $this->render('_formUpdate', [
        'votazione' => $votazione,
    ]);
}