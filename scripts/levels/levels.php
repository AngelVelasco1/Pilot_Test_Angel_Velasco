<?php
namespace App;
use App\connect;
use App\Singleton;
class levels extends connect
{
    private $queryPost = 'INSERT INTO levels(id, name_level, group_level) VALUES (:identification, :level, : group_level)';
    private $queryGet = 'SELECT id AS "identification", SELECT name_level AS "level", SELECT group_level AS "group_level" FROM levels';
    private $queryUpdate = 'UPDATE levels SET name_level = :level,  group_level = : group_level WHERE id = :identification';
    private $queryDelete = 'DELETE FROM levels WHERE id = :identification';
    private $msg;

    use Singleton;

    //? Constructor */
    function __construct(private $id = 1, private $name_level= 1, private $group_level = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function levelsPost()
    {
        try {
            $sentence = $this->conx->prepare($this->queryPost);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("level", $this->name_level);
            $sentence->bindValue("group_level", $this->group_level);


            $sentence->execute();

            $this->msg = ["Code" => 200 + $sentence->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function levelsGet()
    {
        try {
            $sentence = $this->conx->prepare($this->queryGet);
            $sentence->execute();

            $this->msg = ["Code" => 200, "Message" => $sentence->fetchAll(\PDO::FETCH_ASSOC)];

        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }

    //? UPDATE Function */
    function levelsUpdate()
    {
        try {
            $sentence = $this->conx->prepare($this->queryUpdate);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("level", $this->name_level);
            $sentence->bindValue("group_level", $this->group_level);

            $sentence->execute();

            ($sentence->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function levelsDelete()
    {
        try {
            $sentence = $this->conx->prepare($this->queryDelete);
            $sentence->bindValue("identification", $this->id);
            $sentence->execute();

            $this->msg = ["Code" => 200, "Message" => "Deleted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }



}
?>