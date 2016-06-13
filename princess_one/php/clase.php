<?php 
class sesion
  {
var $usuario;
var $contra;
var $tipo;
var $ide;
var $activo;


function set_u($text)
{
  # code...
  $this->usuario=$text;
}
function get_u()
{
  # code...
 return  $this->usuario;
}

function set_p($text)
  {
    # code...
    $this->contra = $text;
  }

  function get_p()
  {
    # code...
    return $this->contra;
  }
  function set_activo($text)
  {
    # code...
    $this->activo = $text;
  }

  function get_activo()
  {
    # code...
    return $this->activo;
  }
  function set_tipou($text)
  {
    # code...
    $this->tipo = $text;
  }

  function get_tipou()
  {
    # code...
    return $this->tipo;
  }

  function set_ide($text)
  {
    # code...
    $this->ide = $text;
  }

  function get_ide()
  {
    # code...
    return $this->ide;
  }


  }



 ?>
  