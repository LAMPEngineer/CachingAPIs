<?php
/**
 *  Parent model to process requests
 *   and have action for child model 
 * 
 */
class MyModel
{
	/**
	 * to hold database connection object
	 * @var db object
	 */
	protected $conn;

	/**
	 * Class constructor
	 * @param object $db database connection object
	 */
	public function __construct($db)
	{
	  $this->conn = $db;

	}

	/**
	 * To get all 
	 * 
	 * @return array users array
	 */
	public function getAll(): array
	{
	  $sql="select student.name, city.city, game.game, study.study, teacher.teacher from student,city,game,study,teacher,fee where student.city=city.id and student.game=game.id and student.study=study.id and student.teacher=teacher.id and student.id=fee.student_id";

      // prepare statement
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $all_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $all_data;

	}


}
