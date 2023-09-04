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
        $dataToStore = [
            'name' => $request['event'],
            'time' => $request['scheduled_at'],
        ];

        return $this->db->insert('tbl_event', $dataToStore);
    }

    function getEvents(string $date) {
        $eventsArr = $this->db->select('tbl_event', [
            'id',
            'name',
            'time',
            'status',
        ], 
        [
            ['time', ' LIKE ', "%$date%"],
        ]);

        return json_encode($eventsArr, JSON_PRETTY_PRINT);
    }
}
