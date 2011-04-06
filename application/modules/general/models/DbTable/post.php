<?php

/* create by lxj
   2011-03-28   v 1.1
   rewrite by lxj
   2011-04-03   v 0.2
 */

class General_Models_DbTable_Post extends Zend_Db_Table_Abstract
{
    protected $_name = 'ge_posts';

	public function getPost($postId)
	{
		$postId = (int)$postId;
		$row = $this->fetchRow('postId = ' . $postId);
		if (!$row) {
			throw new Exception("Could not find row $postId");
		}
		return $row->toArray();
	}

	public function addPost(
								$name
								)
	{
		$data = array (	
			'name' => $name
		);
		$this->insert($data);
	}

	public function updatePost(
								$postId,
								$name
								)
	{
		$data = array (
			'postId' => $postId,
			'name' => $name
		);
		$this->update($data, 'postId = ' . (int)$postId);
	}

	public function deletePost($postId)
	{
		$this->delete('postId = ' . (int)$postId);
	}
}

?>
