<?php

namespace Tekstove\Artist;

use \PDOX AS PDOX,
	\Exception AS Exception;

/**
 * Description of Artist
 *
 * @author potaka
 */
class Artist {

	private $id;
	private $name;
	private $redirectTo = null;
	private $nameAlternatives = null;

	function __construct($data) {

		if (is_int($data)) {
			$pdo = PDOX::singleton();
			$stm = $pdo->prepare("
				SELECT
					*
				FROM
					`artists`
				WHERE
					`id` = :id
			");
			$stm->bindValue(':id', $data);
			$stm->execute();
			if ($stm->rowCount() == 0) {
				
				$stm = $pdo->prepare("
					SELECT
						MAX(`id`) AS `maxId`
					FROM
					`artists`
				");
				
				$stm->execute();
				$maxArtistIdData = $stm->fetch();
				$maxArtistId = $maxArtistIdData['maxId'];
				
				if ($data < $maxArtistId) {
					throw new ArtistException("{$data} artist deleted", ArtistException::DELETED);
				} else {
					throw new ArtistException("{$data} artist not found", ArtistException::NOT_FOUND);
				}
			}

			$data = $stm->fetch();
			$this->id = $data['id'];
			$this->name = $data['name'];
			$this->redirectTo = $data['redirect_to_artist_id'];
			if (isset($data['name_alternatives'])) {
				$this->nameAlternatives = $data['name_alternatives'];
			}
		}

		if ($this->redirectTo === '0') {
			throw new ArtistException('not found', 404);
		}

		if ($this->redirectTo > 0) {
			throw new ArtistException($this->redirectTo, 301);
		}
	}

	public function getId() {
		return $this->id;
	}

	/**
	 * 
	 * @param type $htmlSpecials
	 * @return type
	 */
	public function getName($htmlSpecials = true) {
		$return = $this->name;
		if ($htmlSpecials) {
			$return = htmlspecialcharsX($return);
		}
		return $return;
	}

	public function getRedirectTo() {
		return $this->redirectTo;
	}

	public function delete() {
		$pdo = PDOX::singleton();

		$stm = $pdo->prepare("
			UPDATE
				`artists`
			SET
				`redirect_to_artist_id` = 0
			WHERE
				`id` = :id
		");
		$stm->bindValue(':id', $this->id);
		$stm->execute();
	}

	public static function getSqlOnlyActive() {
		return "
			redirect_to_artist_id IS NULL
		";
	}

	/**
	 * 
	 * @return string
	 */
	public function getNameAlternatives() {
		if ($this->nameAlternatives === NULL) {
			$pdo = \PDOX::singleton();
			$stm = $pdo->prepare("
				SELECT
					`name_alternatives`
				FROM
					`artists`
				WHERE
					`id` = :id
			");
			$stm->bindValue(':id', $this->getId());
			$stm->execute();
			$artistData = $stm->fetch();
			$this->nameAlternatives = $artistData['name_alternatives'];
		}
		return $this->nameAlternatives;
	}

}
