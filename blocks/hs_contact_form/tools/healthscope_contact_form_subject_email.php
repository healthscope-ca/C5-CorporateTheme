<?php
namespace Application\Block\HsContactForm\Tools;

use Database;

class HealthscopeContactFormSubjectEmail extends BusinessDataModel
{
	private $tableName = 'bthscontactformsubjectemail';

	public static function getList()
	{
		$list = array();

		$db = Database::connection();
		//$sql = 'SELECT * FROM bthscontactformsubjectemail order by seID';
		$sql = "select * from `bthscontactformsubjectemail` order by `parentSeID`, `sortOrder`, `description`;"	;
		$rows = $db->getAll($sql, $vals);
		foreach ($rows as $row) 
		{
			$list[intval($row['seID'])] = array(
				  'seID'           => $row['seID']
				, 'parentSeID'     => $row['parentSeID']
				, 'recipientEmail' => $row['recipientEmail']
				, 'description'    => $row['description']
				, 'sortOrder'      => $row['sortOrder']
			);
//			$vals = array(intval($this->bID), intval($pendingQuestion['msqID']));
//			$db->query('DELETE FROM btFormQuestions WHERE bID=? AND msqID=?', $vals);
		}
		
		return $list;
	 }
}
?>
