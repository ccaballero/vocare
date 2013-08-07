<?php

class UsuarioGrupoConvocatoriaTable extends Doctrine_Table
{
    public static function getInstance() {
        return Doctrine_Core::getTable('UsuarioGrupoConvocatoria');
    }

    public function getUsuarios($convocatoria, $grupo) {
        $q1 = Doctrine_Query::create()
            ->select('u.user_id')
            ->from('UsuarioGrupoConvocatoria u')
            ->where('u.convocatoria_id = ?', $convocatoria->getId())
            ->andWhere('u.grupo_id = ?', $grupo->getId());
        $array = $q1->fetchArray();

        $users = array();
        foreach ($array as $user) {
            $users[] = $user['user_id'];
        }

        $list_users = implode(',', $users);
        if (!empty($list_users)) {
            $q2 = Doctrine_Core::getTable('sfGuardUser')
              ->createQuery('u')
              ->where('u.id IN (' . $list_users . ')');

            return $q2->execute();
        } else {
            return array();
        }
    }
}