<?php

use App\Models\SeoSetting;

if (!function_exists('getSeo')) {
    function getSeo($pageType, $referenceId = null)
    {
        return SeoSetting::where('page_type', $pageType)
            ->where('reference_id', $referenceId)
            ->first();
    }
}
