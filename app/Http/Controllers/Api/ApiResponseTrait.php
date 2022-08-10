<?php
/**
 * Created by PhpStorm.
 * User: asd
 * Date: 09/06/2022
 * Time: 12:45 م
 */

namespace App\Http\Controllers\Api;


    trait ApiResponseTrait
    {
        public function apiResponse($data=null, $msg= null, $status=null){
            $array =[
                'data'   => $data,
                'msg'    => $msg,
                'status' => $status,
            ];

            return response($array);
        }


        public function postValidate($post=null){
            if (!$post){
            return $this->apiResponse( null ,'this post not founded',404);
            }
            $post-> delete();
            return $this->apiResponse( null,'this post deleted',201);


        }
    }