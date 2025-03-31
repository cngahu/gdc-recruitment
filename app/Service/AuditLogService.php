<?php

namespace App\Service;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
class AuditLogService
{
    public static function record($activityType, $description, $tableName, $recordId, $actionData = null)
    {
        // Get the user performing the action
        $userId = Auth::id();

        // Get the user's IP address and user agent
        $ipAddress = Request::ip();
        $userAgent = Request::header('User-Agent');
        // Convert actionData to JSON if it's an array
        if (is_array($actionData)) {
            $actionData = json_encode($actionData);
        }
        // Create the audit log entry
        AuditLog::create([
            'user_id' => $userId,
            'activity_type' => $activityType,
            'activity_description' => $description,
            'table_name' => $tableName,
            'record_id' => $recordId,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'action_data' => $actionData, // (optional) JSON data if applicable
        ]);
    }
}
