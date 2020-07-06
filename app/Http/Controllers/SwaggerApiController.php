<?php
namespace App\Http\Controllers;

class SwaggerApiController extends Controller
{

/**
 *
 * @SWG\Post(
 *   path="/api/user/login",
 *   summary="User Login",
 *   consumes={"application/x-www-form-urlencoded"},
 *   produces={"application/json"},
 *   operationId="signup",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=406, description="not acceptable"),
 *   @SWG\Response(response=500, description="internal server error"),
 *       @SWG\Parameter(
 *          name="email",
 *          in="formData",
 *          required=true,
 *          type="string"
 *      ),
 *       @SWG\Parameter(
 *          name="password",
 *          in="formData",
 *          required=true,
 *          type="string"
 *      ),
 * )
 *
 */

/**
 *
 * @SWG\Post(
 *   path="/api/user/signup",
 *   summary="User Signup",
 *   consumes={"application/x-www-form-urlencoded"},
 *   produces={"application/json"},
 *   operationId="signup",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=406, description="not acceptable"),
 *   @SWG\Response(response=500, description="internal server error"),
 *		@SWG\Parameter(
 *          name="first_name",
 *          in="formData",
 *          required=true,
 *          type="string"
 *      ),
 *      @SWG\Parameter(
 *          name="last_name",
 *          in="formData",
 *          required=true,
 *          type="string"
 *      ),
 *       @SWG\Parameter(
 *          name="email",
 *          in="formData",
 *          required=true,
 *          type="string"
 *      ),
 *       @SWG\Parameter(
 *          name="password",
 *          in="formData",
 *          required=true,
 *          type="string"
 *      ),
 *       @SWG\Parameter(
 *          name="confirm_password",
 *          required=true,
 *          in="formData",
 *          type="string"
 *      ),
 *      @SWG\Parameter(
 *          name="phone_number",
 *          required=true,
 *          in="formData",
 *          type="string"
 *      ),
 *      @SWG\Parameter(
 *          name="profile_file[]",
 *          in="formData",
 *			description="profile file",
 *          type="file"
 *      ),
 * )
 *
 */

/**
 *
 * @SWG\Post(
 *   path="/api/user/update",
 *   summary="User Update",
 *   consumes={"application/x-www-form-urlencoded"},
 *   produces={"application/json"},
 *   operationId="signup",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=406, description="not acceptable"),
 *   @SWG\Response(response=500, description="internal server error"),
 *    	@SWG\Parameter(
 *          name="user_id",
 *          in="formData",
 *          type="string"
 *      ),
 *		@SWG\Parameter(
 *          name="first_name",
 *          in="formData",
 *          type="string"
 *      ),
 *      @SWG\Parameter(
 *          name="last_name",
 *          in="formData",
 *          type="string"
 *      ),
 *      @SWG\Parameter(
 *          name="phone_number",
 *          in="formData",
 *          type="string"
 *      ),
 *       @SWG\Parameter(
 *          name="address",
 *          in="formData",
 *          type="string"
 *      ),
 *      @SWG\Parameter(
 *          name="profile_file[]",
 *          in="formData",
 *			description="profile file",
 *          type="file"
 *      ),
 * )
 *
 */

 /**
 *
 * @SWG\Post(
 *   path="/api/chat/send-message",
 *   summary="Send Message",
 *   consumes={"application/x-www-form-urlencoded"},
 *   produces={"application/json"},
 *   operationId="signup",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=406, description="not acceptable"),
 *   @SWG\Response(response=500, description="internal server error"),
 *       @SWG\Parameter(
 *          name="message",
 *          in="formData",
 *          required=true,
 *          type="string"
 *      ),
 *       @SWG\Parameter(
 *          name="from_user_id",
 *          in="formData",
 *          required=true,
 *          type="integer"
 *      ),
 *      @SWG\Parameter(
 *          name="to_user_id",
 *          in="formData",
 *          required=true,
 *          type="integer"
 *      ),
 * )
 *
 */
/**
 *
 * @SWG\Post(
 *   path="/api/chat/get-message",
 *   summary="Get Message",
 *   consumes={"application/x-www-form-urlencoded"},
 *   produces={"application/json"},
 *   operationId="signup",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=406, description="not acceptable"),
 *   @SWG\Response(response=500, description="internal server error"),
 *      @SWG\Parameter(
 *          name="id",
 *          in="formData",
 *          required=true,
 *          type="integer"
 *      ),
 * )
 *
 */
/**
 *
 * @SWG\Post(
 *   path="/api/chat/all-message",
 *   summary="All Message",
 *   consumes={"application/x-www-form-urlencoded"},
 *   produces={"application/json"},
 *   operationId="signup",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=406, description="not acceptable"),
 *   @SWG\Response(response=500, description="internal server error"),
 *      @SWG\Parameter(
 *          name="to",
 *          in="formData",
 *          required=true,
 *          type="integer"
 *      ),
 *     @SWG\Parameter(
 *          name="from",
 *          in="formData",
 *          required=true,
 *          type="integer"
 *      ),
 * )
 *
 */
}