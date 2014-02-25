<?php
class EventListener{

	public function __construct(array $attributes =  array()){
		
		Event::listen('product.traffic', function($product){
			 $ip = Location::getIp();
			 $pTraffic = Traffic::where('product_id', $product->id)
			 					 ->where('ip', $ip)
			 					 ->orderBy('created_at', 'DESC')
			 					 ->first(); 
			if(is_object($pTraffic)){
				 $hourdiff = round((time() - strtotime($pTraffic->created_at))/3600, 1);
	 
				 if($hourdiff > 24){
				 	 $traffic = new Traffic();
				 	 $traffic->product_id = $product->id;
				 	 $traffic->ip = $ip;
				 	 $traffic->save();
				 }
			}else{
				$traffic = new Traffic();
			 	 $traffic->product_id = $product->id;
			 	 $traffic->ip = $ip;
			 	 $traffic->save();
			}

		});	
	}
}