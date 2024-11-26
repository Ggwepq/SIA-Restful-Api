<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HttpResponses
{
    /**
     * Return a successful JSON response.
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $status_code
     * @return JsonResponse
     */
    protected function success($data = null, string $message = null, int $status_code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message ?? 'Request was successful.',
            'data' => $data
        ], $status_code);
    }

    /**
     * Return an error JSON response.
     *
     * @param string|null $message
     * @param mixed $data
     * @param int $status_code
     * @return JsonResponse
     */
    protected function error(string $message = null, $data = null, int $status_code = 400): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message ?? 'An error occurred.',
            'data' => $data
        ], $status_code);
    }
}
