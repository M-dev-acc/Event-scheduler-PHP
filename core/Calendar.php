<?php

class Calendar 
{
    /**
     * Get current year
     * 
     * @var int
     */
    protected int $currentYear;

    /**
     * Accept and set object properties
     * 
     * @param int $currentYear
     */
    public function __construct(int $currentYear) {
        $this->currentYear = $currentYear;
    }

    /**
     * Initialize calendar
     * 
     * @return array
     */
    private function initialize(): array
    {
        $monthsArray = cal_info(0);
        return $monthsArray;
    }

    /**
     * Return days of month
     * 
     * @return array
     */
    public function getDaysOfMonths(): array
    {
        $calendarInfo = $this->initialize();
        $monthsArray = $calendarInfo['months'];
        $year = $this->currentYear;

        $daysOfMonthsArr = array_map(function ($monthArr, $monthIndex) use ($year)
        {            
            $monthInfoArr[$monthIndex] = [
                'name' => $monthArr,
                'days_of_month' => cal_days_in_month(CAL_GREGORIAN, $monthIndex, $year),
            ];
            return $monthInfoArr[$monthIndex];
        },
        $monthsArray, array_keys($monthsArray));

        # REMOVE 0 INDEX FORM THE ARRAY
        array_unshift($daysOfMonthsArr, "");
        unset($daysOfMonthsArr[0]);

        return $daysOfMonthsArr;
    }

    /**
     * Return array of days
     * 
     * @return array
     */
    public function getDaysOfweek(): array
    {
        return [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        ];
    }

    public function daysHeadingRow()
    {
        $daysOfWeek = $this->getDaysOfweek();

    }

    public function createHtmlElement(string $htmlTag, array $attributesArr = []): DOMElement
    {
        $nodeObj = new DOMDocument('0.1', 'iso-8859-1');
        $htmlElement = $nodeObj->createElement($htmlTag);

        foreach ($attributesArr as $attributeName => $attributeValue) {
            $htmlElement->setAttribute($attributeName, $attributeValue);            
        }

        return $htmlElement;
    }
}
