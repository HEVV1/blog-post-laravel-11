<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;
use App\RequestsCRUD\AuthRequestCRUD;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private readonly AuthRequestCRUD $_authServiceCRUD;

    public function __construct(AuthRequestCRUD $authRequestCRUD)
    {
        $this->_authServiceCRUD = $authRequestCRUD;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $userAndToken = $this->_authServiceCRUD->register($request);

            return response()->json($userAndToken, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
