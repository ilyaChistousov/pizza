<?php

use Illuminate\Http\JsonResponse;

function responseOk(): JsonResponse
{
    return response()->json([
        'success' => true
    ]);
}

function responseCreated(int $id): JsonResponse
{
    return response()->json([
        'id' => $id
    ], 201);
}

function responseWithResource(array $data): JsonResponse
{
    return response()->json($data);
}
