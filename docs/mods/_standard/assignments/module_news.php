<?php
/***********************************************************************/
/* ATutor															   */
/***********************************************************************/
/* Copyright (c) 2002-2009											   */
/* Adaptive Technology Resource Centre / Inclusive Design Institute	   */
/* http://atutor.ca													   */
/*																	   */
/* This program is free software. You can redistribute it and/or	   */
/* modify it under the terms of the GNU General Public License		   */
/* as published by the Free Software Foundation.					   */
/***********************************************************************/
// $Id: module_news.php 9335 2010-02-11 16:29:01Z hwong $
/*
 * Get the latest updates of this module
 * @return list of news, [timestamp]=>
 */
function assignments_news() {
	global $db, $enrolled_courses;
	$news = array();

	if ($enrolled_courses == ''){
		return $news;
	} 

	$sql = 'SELECT * FROM '.TABLE_PREFIX.'assignments WHERE course_id IN '.$enrolled_courses.' ORDER BY date_due DESC';
	$result = mysql_query($sql, $db);
	if($result){
		while($row = mysql_fetch_assoc($result)){
			$news[] = array('time'=>$row['date_due'], 
							'object'=>$row, 
							'thumb'=>'',
							'link'=>_AT('ASSIGNMENT_HAS_BEEN_POSTED', $row['title']));
		}
	}
	return $news;
}

?>
