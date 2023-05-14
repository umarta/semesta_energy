<?php


use App\Models\Position;
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

function searchMethod($request, $model, $column)
{
    $search = $request->search;

    return $model::query()->where($column, 'like', "%$search%");
}

function clean($string): array|string|null
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

