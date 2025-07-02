<?php
namespace App\Http\Helpers;
use App\GlobalSetting;
use Carbon\Carbon;
use App\Country;

class GeneralHelper
{
	public static function setOption($optionKey,$optionValue){

		
		$record = GlobalSetting::where("option_key",$optionKey)->first();
        if(!$record){
           $object = GlobalSetting::create(["option_key" => $optionKey, 'option_value' => $optionValue]);
        }else{
           $object = GlobalSetting::where("option_key" , $optionKey)->update(['option_value' => $optionValue]);
        }

		return  $object->id ?? false;
	}

	public static function getOption($optionKey, $defaultValue = ''){

		$result = GlobalSetting::where("option_key",$optionKey)->first();

		return  $result->option_value ?? $defaultValue;
	}

	public static function deleteOption($optionKey){

		$record = GlobalSetting::where("option_key",$optionKey)->first();
        if(!$record){
            return abort(404);
        }
        return GlobalSetting::where("option_key",$optionKey)->delete();
	}

	public static function getDaysArray($date = ''){

        $today = !empty($date) ? $date : Carbon::now(); 
        $currentDay = $today->day;       
        $currentMonth = $today->month;       

        $lastDayofMonth = $today->endOfMonth();
        $lastDay = $lastDayofMonth->day;

        $days = [];

        for ($i=$currentDay; $i <= $lastDay; $i++){ 
            $days[] = $i;
        }

        return  $days;
    }

    public static function getMonthsArray(){

    	$today = Carbon::now(); 
        $currentDay = $today->day;       
        $currentMonth = $today->month;

    	 $months = ['January','Fabruary','March','April','May','June','July','August','September','October','November','December'];
    	 $monthsArray = [];
    	 foreach ($months as $key => $value) {
    	 	$counter = $key+1;
    	 	if($counter >= $currentMonth){
    	 		$monthsArray[$counter] = $value;
    	 	}
    	 	
    	 }

    	 return $monthsArray;
    }


    public static function getTimeSlots(){

    	$timeSlots = [];
    	$totalDays = 23;
    	for ($i=0; $i <= $totalDays; $i++) {

    		$timeSlots[$i] = str_pad($i, 2, '0', STR_PAD_LEFT).':00'; 
    		
    	}

    	return $timeSlots;

    }

    public static function timeSlotFormat($timeSlot){
    			$extraZero = str_contains($timeSlot,':00') ? '' : ':00';
    	return str_pad($timeSlot, 2, '0', STR_PAD_LEFT).$extraZero;
    }


    public static function getAvailableDatesFromTimeSLots($availabeTimeSLots){

    	$availableDates = [];
    	if(!empty($availabeTimeSLots)){
            foreach ($availabeTimeSLots as $key => $value) {
                $month = $value->month;
                $availableDates[] = str_pad($value->day, 2, '0', STR_PAD_LEFT).'/'.str_pad($month, 2, '0', STR_PAD_LEFT).'/'.$value->year;
            }
           
        }       

        return array_unique($availableDates);
    }

    public static function isSlotAlreadyBooked($bookedSlots,$timeFrom,$timeTo){

    	if(!empty($bookedSlots)){
    		foreach ($bookedSlots as $key => $record) {
    			
    			$timeFrom = GeneralHelper::timeSlotFormat($timeFrom);
    			$timeTo = GeneralHelper::timeSlotFormat($timeTo);
    			
    			if($record->booking_time == "$timeFrom till $timeTo"){
    				
    				return true;
    			}
    		}
    	}

    	return false;
    }


    public static function getAvailableTimeSlots(){

        $timeFrom = GeneralHelper::getOption('laundry_available_time_from');
        $timeTo = GeneralHelper::getOption('laundry_available_time_to');
    }



   
    public static function getCitiesByCountry($countryId)
    {
        $country = Country::with(['states.cities' => function ($query) {
            $query->orderBy('name', 'asc');
        }])->find($countryId);

        if (!$country) {
            return collect();
        }

        $cities = collect();
        foreach ($country->states as $state) {
            $cities = $cities->merge($state->cities);
        }

        return $cities->sortBy('name')->values(); // Ensure fully sorted
    }
    

    public static function getStatusLabel($status = 1,$color = 'success'){

        if(is_numeric($status)){

            $status = $status == 1 ? 'Active' : 'Deactive';
            $color = $status == 1 ? 'success' : 'danger';
        }

        return '<span class="badge badge-'.$color.'">'.$status.'</span>';
    }


    public static function getMediaWithPublicDir($url){
        return str_replace('/storage/', '/public/storage/', $url);
    }

    public static function detectNumberUnit($number)
    {
        $number = (int)$number; // ensure integer

        if ($number >= 10000000) {
            return ['amount' => number_format($number / 10000000, 0) , 'unit' => 'Crore'];
        } elseif ($number >= 100000) {
            return ['amount' => number_format($number / 100000, 0) , 'unit' => 'Lakh'];
            
        } elseif ($number >= 1000) {
            return ['amount' => number_format($number / 1000, 0) , 'unit' => 'Thousand'];            
        } else {
            return ['amount' => number_format($number) , 'unit' => 'Hundered'];
        }
    }


    public static function formatCurrency($amount, $symbol = 'PKR', $decimals = 0) {
        return $symbol . ' ' . number_format($amount, $decimals);
    }
    /*public static function timeTo24($time){

        if(str_contains($time,'AM'){

            $time = explode(':', $time);
            $hour = (int)$time[0];
            if($hour < 12){
                $hour = $hour + 12;
            }else{
                $hour = 0;
            }
            

        }

    }*/
}