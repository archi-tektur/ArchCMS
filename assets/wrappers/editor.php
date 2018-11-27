<?php

use ArchAPI\Controller\CMS;

if(isset($_GET['id']))
    $data = CMS::getEditorPost($_GET['id']);
else
    return ["data" => "Data read problem"];

return ['data' => $data];