<?php


use Illuminate\Http\JsonResponse;


function errorResponse($message): JsonResponse
{
    return response()->json([
        'success' => false,
        'message' => $message,
        'data' => null
    ], 500);
}

function warningResponse($message, $code = null): JsonResponse
{
    return response()->json([
        'success' => false,
        'message' => $message,
        'data' => null

    ], $code ?? 422);
}

function emptyResponse($message): JsonResponse
{
    return response()->json([
        'success' => true,
        'message' => $message,
        'data' => null

    ], 200);
}

function writeResponse($data, $message): JsonResponse
{
    return response()->json([
        'success' => true,
        'message' => $message,
        'data' => $data

    ], 200);
}


function notFoundResponse($message): JsonResponse
{
    return response()->json([
        'success' => false,
        'message' => $message,
        'data' => null

    ], 404);
}


