<?php
/**
 *  Index view 
 */
class IndexView
{
	/**
	 * Resource list view 
	 * @param array $content 
	 * 
	 * @return string       
	 */
	public function render($content)
	{
		$str="<table border='1'>";
		$str.="<tr><td>Name</td><td>City</td><td>Game</td><td>Study</td><td>Teacher</td></tr>";

			foreach($content as $list){				
				$list = (object) $list;

				$str.="<tr><td>".$list->name."</td><td>".$list->city."</td><td>".$list->game."</td><td>".$list->study."</td><td>".$list->teacher."</td></tr>";
			}
		$str.="</table>";

		return $str;
	}


}