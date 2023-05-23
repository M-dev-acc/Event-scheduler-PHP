<?php
namespace Core;

use Core\Database;

class Event
{
    /**
     * Database driver object
     * 
     * @var PDO|null
     */

    protected $db = null;

    /**
     * Intialize properties
     */
    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Store an event in to the database
     * 
     * @param array $request
     * @return array|bool
     */
    public function createEvent(array $request)
    {
        $dbDriver = $this->db;
        $dataToStore = [
            'name' => $request['event'],
            'time' => $request['scheduled_at'],
        ];

        return $dbDriver->insert('tbl_event', $dataToStore);
    }
}
