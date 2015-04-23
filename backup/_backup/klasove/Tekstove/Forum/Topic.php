<?php

namespace Tekstove\Forum;

/**
 * Description of Topic
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Topic
{

    private $id;
    private $categoryId;

    function __construct($data)
    {
        if (is_int($data)) {
            $stm = \PDOX::singleton()->prepare("SELECT * FROM forum_topic WHERE id = :id");
            $stm->bindValue('id', $data);
            $stm->execute();
            if ($stm->rowCount() === 0) {
                throw new Exception('topic not found');
            }

            $data = $stm->fetch();
        }

        if (!is_array($data)) {
            throw new Exception('expected data to be array');
        }

        $this->id = (int) $data['id'];
        $this->categoryId = (int) $data['topic_razdel'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }



}
