<?php

namespace Tekstove;

use \PDOX,
	\PDO;

/**
 * Description of Acl
 *
 * @author po_taka
 */



class Acl {

	const CHAT_BAN_ROUGH_MESSAGES = 'chat_ban_rough_messages';
	const CHAT_BAN = 'chat_ban';
	const LYRIC_DELETE_DOUBLED = 'lyric_delete_doubled';
    const LYRIC_TRANSLATION_CONFIRM = 'lyric_translation_confirm';
	const CHAT_CENSORE = 'chat_censore';
    const USER_CHANGE_OWN_RANG = 'user_change_own_rang';
    const FORUM_CATEGORY_ACCESS_HIDDEN = 'category_access_hidden';
    
	protected $sessionKey = 'tekstoveSessionKey';

	function __construct() {
		
	}

	public function isAllowed($action) {

		if (!isset($_SESSION[$this->sessionKey])) {
			$_SESSION[$this->sessionKey] = array();
		}

		if (array_key_exists($action, $_SESSION[$this->sessionKey])) {
			return $_SESSION[$this->sessionKey][$action];
		}
        
		$pdo = PDOX::singleton();

		$stm = $pdo->prepare("
			SELECT
				permissions.*
			FROM
				permissions
			INNER JOIN
				 `permission_group_permissions`
					ON `permission_group_permissions`.`permissionId` = `permissions`.`id`
			INNER JOIN
				permission_group_users
					ON
						permission_group_users.groupId = `permission_group_permissions`.groupId
						AND userId = :userId
			WHERE
				`name` = :name
		");

		$stm->bindValue('name', $action);
		$stm->bindValue('userId', \currentUser::getInstance()->getId(), PDO::PARAM_INT);

		$stm->execute();

		if ($stm->rowCount() > 0) {

			if ($stm->rowCount() > 1) {

				zapis('permission check error, action: ' . $action . ' userId:' . \currentUser::getInstance()->getId());
				return null;
			}

			$data = $stm->fetch();
			
			$_SESSION[$this->sessionKey][$action] = $data['value'];
			
            // check for custom permission
            $stmCustomPermission = $pdo->prepare("
                SELECT
                    `permissions`.`value` AS `value`
                FROM
                    `permission_users`
                INNER JOIN
                    `permissions`
                        ON
                            permissions.`name` = :permissionName
                            AND permissions.id = permission_users.permissionId
                WHERE
                    `userId` = :userId
            ");
            
            $stmCustomPermission->bindValue('userId', \currentUser::getInstance()->getId());
            $stmCustomPermission->bindValue('permissionName', $data['name']);
            $stmCustomPermission->execute();
            if ($stmCustomPermission->rowCount() > 0) {
                $customPermissionData = $stmCustomPermission->fetch();
                if ($customPermissionData['value'] > 0) {
                    $_SESSION[$this->sessionKey][$action] = $customPermissionData['value'];
                    return $customPermissionData['value'];
                }
            }
			
			return $data['value'];
			
		}
		
        $_SESSION[$this->sessionKey][$action] = null;
		return null;
	}

}
