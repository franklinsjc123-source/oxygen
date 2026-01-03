<?php

namespace App\Repository;

use Illuminate\Container\Container;
use App\Models\Zonal;
use App\Models\Route;
use App\Models\Pincode;
use App\Models\Departments;
use App\Helper\DataQueryHelper;
use App\Helper\ObjectHelper;
use App\Helper\CommonHelper;
use App\Models\ViewModels\CommonReturnVM;

class MasterRepo
{

      protected DataQueryHelper $dataQuery;
      protected ObjectHelper $objectHelper;
      protected CommonHelper $commonHelper;
      protected Container $container;

      function __construct(
            DataQueryHelper $dataQuery,
            ObjectHelper $objectHelper,
            CommonHelper $commonHelper
      ) {
            $this->container = Container::getInstance();
            $this->dataQuery = $dataQuery;
            $this->objectHelper = $objectHelper;
            $this->commonHelper = $commonHelper;
      }
      public function saveZonals($viewModel): CommonReturnVM
      {
            $commonReturn = new CommonReturnVM();            
            try {
                  if ($viewModel->zonalId == -1) {
                        $this->objectHelper->removeProperties($viewModel, ['zonalId']);
                        $model = new Zonal();
                        $model->fill((array)$viewModel);
                        $model->save();

                        $commonReturn->statusCode = 1;
                        $commonReturn->statusMsg = "Successfully Saved";
                        $commonReturn->data = $model;
                  } else {
                        $existingModel = Zonal::where('id', $viewModel->DepartmentId)->first();
                        $this->objectHelper->removeProperties($viewModel, ['zonalId']);
                        $existingModel->fill((array)$viewModel);
                        $existingModel->update();

                        $commonReturn->statusCode = 1;
                        $commonReturn->statusMsg = "Successfully Updated";
                        $commonReturn->data = $existingModel;
                  }
            } catch (\Exception $e) {

                  $commonReturn->statusCode = -1;
                  $commonReturn->statusMsg = $e->getMessage();
                  $commonReturn->data = null;
            }

            return $commonReturn;
      }
      public function saveRoute($viewModel): CommonReturnVM
      {
            $commonReturn = new CommonReturnVM();            
            try {
                  if ($viewModel->routeId == -1) {
                        $this->objectHelper->removeProperties($viewModel, ['routeId']);
                        $model = new Route();
                        $model->fill((array)$viewModel);
                        
                        $model->save();

                        $commonReturn->statusCode = 1;
                        $commonReturn->statusMsg = "Successfully Saved";
                        $commonReturn->data = $model;
                  } else {
                        $existingModel = Zonal::where('id', $viewModel->id)->first();
                        $this->objectHelper->removeProperties($viewModel, ['routeId']);
                        $existingModel->fill((array)$viewModel);
                        $existingModel->update();

                        $commonReturn->statusCode = 1;
                        $commonReturn->statusMsg = "Successfully Updated";
                        $commonReturn->data = $existingModel;
                  }
            } catch (\Exception $e) {

                  $commonReturn->statusCode = -1;
                  $commonReturn->statusMsg = $e->getMessage();
                  $commonReturn->data = null;
            }

            return $commonReturn;
      }


      public function saveDepartments($viewModel): CommonReturnVM
      {
            $commonReturn = new CommonReturnVM();            
            try {
                  if ($viewModel->departmentId == -1) {
                        $this->objectHelper->removeProperties($viewModel, ['departmentId']);
                        $model = new Departments();
                        $model->fill((array)$viewModel);
                        $model->save();

                        $commonReturn->statusCode = 1;
                        $commonReturn->statusMsg = "Successfully Saved";
                        $commonReturn->data = $model;
                  } else {
                        $existingModel = Departments::where('id', $viewModel->id)->first();
                        $this->objectHelper->removeProperties($viewModel, ['departmentId']);
                        $existingModel->fill((array)$viewModel);
                        $existingModel->update();

                        $commonReturn->statusCode = 1;
                        $commonReturn->statusMsg = "Successfully Updated";
                        $commonReturn->data = $existingModel;
                  }
            } catch (\Exception $e) {

                  $commonReturn->statusCode = -1;
                  $commonReturn->statusMsg = $e->getMessage();
                  $commonReturn->data = null;
            }

            return $commonReturn;
      }


      public function savePincodes($viewModel): CommonReturnVM
      {
            $commonReturn = new CommonReturnVM();            
            try {
                  if ($viewModel->pincodeId == -1) {
                        $this->objectHelper->removeProperties($viewModel, ['pincodeId']);
                        $model = new Pincode();
                        $model->fill((array)$viewModel);
                        $model->save();

                        $commonReturn->statusCode = 1;
                        $commonReturn->statusMsg = "Successfully Saved";
                        $commonReturn->data = $model;
                  } else {
                        $existingModel = Pincode::where('id', $viewModel->id)->first();
                        $this->objectHelper->removeProperties($viewModel, ['pincodeId']);
                        $existingModel->fill((array)$viewModel);
                        $existingModel->update();

                        $commonReturn->statusCode = 1;
                        $commonReturn->statusMsg = "Successfully Updated";
                        $commonReturn->data = $existingModel;
                  }
            } catch (\Exception $e) {

                  $commonReturn->statusCode = -1;
                  $commonReturn->statusMsg = $e->getMessage();
                  $commonReturn->data = null;
            }

            return $commonReturn;
      }

      public function checkZonalname($zonalId, $Name)
      {
            $existingData = Zonal::where('name', '=', $Name)->get()->first();

            if ($existingData != null) {
                  return response()->json("Name already exists");
            }
            return response()->json("true");
      }
      public function checkRoutename($zonalId, $Name)
      {
            $existingData = Route::where('name', '=', $Name)->get()->first();

            if ($existingData != null) {
                  return response()->json("Name already exists");
            }
            return response()->json("true");
      }
      public function checkDepartmentname($zonalId, $Name)
      {
            $existingData = Departments::where('name', '=', $Name)->get()->first();

            if ($existingData != null) {
                  return response()->json("Name already exists");
            }
            return response()->json("true");
      } 
      public function getAllZonal()
      {
            $objList = Zonal::select(
                  'id',
                  'name',
                  'status',
            )->orderBy('id', 'ASC')->get();
            return $objList;
      }
      public function getAllRoute()
      {
            $objList = Route::with('zonals')->get();
            return $objList;
      }
      public function getAllDepartments()
      {
            $objList = Departments::select(
                  'id',
                  'name',
                  'status',
            )->orderBy('id', 'ASC')->get();
            return $objList;
      }
      public function getZonalById($routeId) {
            $objList = Route::select(
                  'id',
                  'name',
                  'status',
            )->where('id',$routeId)->get();
            return $objList;
      }
} 
