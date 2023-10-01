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

    /**
     * Get collection of the events list
     * 
     * @param string $date
     * @return bool|string
     */
    public function getEvents(string $date) {
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

    /**
     * Get single event data
     * 
     * @param int $eventId
     * @return bool|string
     */
    public function getEvent(int $eventId){
        $eventArr = $this->db->select('tbl_event', [
            'id',
            'name',
            'status',
            'time',
        ], 
        [
            ['id', '=', $eventId],
        ]);

        return json_encode($eventArr, JSON_PRETTY_PRINT);
    }

    /**
     * Update Event data
     * 
     * @param array $request
     * @return array|bool
     */
    public function updateEvent(array $request, array $whereClause) {
        return $this->db->update('tbl_event', $request, $whereClause);
    }

    /**
     * Delete selected event
     * 
     * @param int $eventId
     * @return array|bool
     */
    public function deleteEvent(int $eventId) {
        return $this->db->delete('tbl_event', $eventId);
    }

    /**
     * Check event are assigned to given date
     * 
     * @param string $date
     * @return bool
     */
    public function getEventsConut(string $date) : int {
        $eventsCountQuery = $this->db->executeQuery("SELECT COUNT(*) as events_count FROM tbl_event WHERE time=:date", [':date' => $date]);
        
        return $eventsCountQuery[0]['events_count'];
    }
}
