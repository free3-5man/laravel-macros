<?php

namespace Freeman\LaravelMacros\Macros\Carbon;

use Carbon\Carbon;

/**
 * Get natural weeks array of this week, each item in this array has the week start date and the week end date.
 * Assume monday is a week start while sunday is a week end.
 *
 * @return string
 */
class GetNaturalWeeks
{
    public function __invoke()
    {
        return function () : array {
            /** @var Carbon $this */
            $yearMonth = $this->format('Y-m');

            $weekinfo = [];
            $end_date = date('d', strtotime($yearMonth . ' +1 month -1 day'));
            for ($i = 1; $i < $end_date; $i = $i + 7) {
                $w = date('N', strtotime($yearMonth . '-' . $i));

                $weekinfo[] = [date('Y-m-d', strtotime($yearMonth . '-' . $i . ' -' . ($w - 1) . ' days')), date('Y-m-d', strtotime($yearMonth . '-' . $i . ' +' . (7 - $w) . ' days'))];
            }

            $dtMonth      = Carbon::createFromFormat('Y-m', $yearMonth);
            $dtMonthStart = $dtMonth->copy()->startOfMonth();
            $dtMonthEnd   = $dtMonth->copy()->endOfMonth();

            $weekinfo[0][0] = $dtMonthStart->toDateString();

            $endDateTmp = $weekinfo[count($weekinfo) - 1][1];
            $dtEndDateTmp = Carbon::createFromFormat('Y-m-d', $endDateTmp);
            if ($dtEndDateTmp->gte($dtMonthEnd))
                $weekinfo[count($weekinfo) - 1][1] = $dtMonthEnd->toDateString();
            else {
                $weekinfo[] = [
                    $dtEndDateTmp->addDay()->toDateString(),
                    $dtMonthEnd->toDateString(),
                ];
            }

            return $weekinfo;
        };
    }
}
