<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use App\Models\Meetings;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Models\ViewModels\CommonReturnVM;
use App\Models\MeetingAttendees;

class MeetingsRepo
{

      protected DataQueryHelper $dataQuery;
      protected ObjectHelper $objectHelper;
      protected Container $container;

      function __construct(DataQueryHelper $dataQuery, ObjectHelper $objectHelper)
      {
            $this->container = Container::getInstance();
            $this->dataQuery = $dataQuery;
            $this->objectHelper = $objectHelper;
      }

      public function getMeetings($loginUserID, $MeetingId)
      {                        
            $sql =  $this->dataQuery->composeSP("MeetingsGet",["LoginUserID" => $loginUserID, "MeetingId" => $MeetingId]); 
            return DB::select($sql->sp, $sql->param);
      }

      public function saveMeetings($viewModel): CommonReturnVM
      { 
            $commonReturn = new CommonReturnVM();                     
            $sql =  $this->dataQuery->composeSP("MeetingsSave", $viewModel);            
            $result =  DB::select($sql->sp, $sql->param);      
            $viewModel->MeetingId =  $result[0]->MeetingId;

            $commonReturn->statusCode =  $result[0]->statusCode;
            $commonReturn->statusMsg = $result[0]->statusMsg;
            $commonReturn->data = $viewModel;   
            return $commonReturn;                       
      }

      public function saveMeetingsAttendees($viewModel): CommonReturnVM
      {  
            $commonReturn = new CommonReturnVM();                     
            $sql =  $this->dataQuery->composeSP("MeetingAttendeesSave", $viewModel);             
            $result =  DB::select($sql->sp, $sql->param);     
            $commonReturn->statusCode =  $result[0]->statusCode;
            $commonReturn->statusMsg = $result[0]->statusMsg;           
            $commonReturn->data = $viewModel;       
            return $commonReturn;                       
      }

      public function getAttendeeList($loginUserID, $MeetingAttendeeId, $MeetingsId)
      {
            $sql =  $this->dataQuery->composeSP("MeetingAttendeesGet",["LoginUserID" => $loginUserID, "MeetingAttendeeId" => $MeetingAttendeeId,"MeetingsId"=>$MeetingsId]); 
            return DB::select($sql->sp, $sql->param);
      }
      
      public function removeeMeetingAttendees($MeetingsId)
      {
            $sql =  MeetingAttendees::where('MeetingAttendeeId', $MeetingsId->MeetingAttendeeId)->firstorfail()->delete();
            return $sql;
      }

      public function meetingsTypeCheck($projectId, $meetingTypeId, $LoginUserID)
      {
            $sql =  $this->dataQuery->composeSP("MeetingsTypeCheck",["ProjectId" => $projectId, "MeetingTypeId"=>$meetingTypeId, "LoginUserID" => $LoginUserID]); 
            return DB::select($sql->sp, $sql->param);
      }

}