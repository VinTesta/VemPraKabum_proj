<?php

#region USUARIOFACTORY
class UsuarioFactory
{
    #region CRIAUSUARIO
    public function criaUsuario($params) {
        $values["idusuario"] = isset($params["idusuario"]) ? $params["idusuario"] : NULL;
        $values["emailusuario"] = isset($params["emailusuario"]) ? $params["emailusuario"] : NULL;
        $values["senhausuario"] = isset($params["senhausuario"]) ? $params["senhausuario"] : NULL;
        $values["nomeusuario"] = isset($params["nomeusuario"]) ? $params["nomeusuario"] : NULL;
        return new Usuario($values);
    }
}
#endregion

?>