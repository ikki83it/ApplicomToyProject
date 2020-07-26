<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
Use App\Event;

use Illuminate\Routing\Controller as BaseController;

class EventController extends BaseController {
    

    public function getAllEvent() {
       // $event = Event::get()->toJson(JSON_PRETTY_PRINT);
       // return response($event, 200);
       return Event::all();
      }

      public function getEvent($id) {
        if (Event::where('id', $id)->exists()) {
            $event = Event::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($event, 200);
          } else {
            return response()->json([
              "message" => "Event not found"
            ], 404);
          }
      }

      public function getFilterEvents($name, $dstat, $end) {
          $arrFiltri = [];
          $arrayDateStart = [];
          $arrayDateEnd = [];
          $arrayName = [];
          if($dstat!='' && $end!=''){
              $arrayDateStart = array('date', '>=', $dstat);
              $arrayDateEnd = array('date', '<=', $end);
            array_push($arrFiltri,$arrayDateStart,$arrayDateEnd);
          }
          if($name != ''){
            $arrayName = array('name', '=', $name);
          }
          if (Event::where([$arrayName, $arrayDateStart, $arrayDateEnd])->exists()) {
            $event = Event::where([$arrayName, $arrayDateStart, $arrayDateEnd])->get()->toJson(JSON_PRETTY_PRINT);
            return response($event, 200);
          } else {
            return response()->json([
              "message" => "Event not found"
            ], 404);
          }
      }

    public function createEvent(Request $request){
        $event = new Event;
        $event->date = $request->date;
        $event->name = $request->name;
        $event->checkyear = $request->checkyear;
        $event->save();
    
        return response()->json([
            "message" => "Event record created"
        ], 201);
    }

    public function updateEvent(Request $request, $id) {
        if (Event::where('id', $id)->exists()) {
            $event = Event::find($id);
            $event->name = is_null($request->name) ? $event->name : $request->name;
            $event->date = is_null($request->date) ? $event->date : $request->date;
            $event->checkyear = is_null($request->checkyear) ? $event->checkyear : $request->checkyear;
            $event->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Event not found"
            ], 404);
            
        }
    }

    public function deleteEvent ($id) {
        if(Event::where('id', $id)->exists()) {
          $event = Event::find($id);
          $event->delete();
  
          return response()->json([
            "message" => "records deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => "Event not found"
          ], 404);
        }
      }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
}