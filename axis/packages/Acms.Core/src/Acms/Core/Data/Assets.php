<?php
namespace Acms\Core\Data;

class Assets
{
    public function getAssetPath($module, $directory, $file)
    {
        $assetDir = RESOURCE_PATH . 'modules' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR;
        $assetUrl = RESOURCE_URL . 'modules/' . $module . '/' . 'assets' . '/' . $directory . '/';

        if (file_exists($assetDir)) {

            if (file_exists($assetDir . $file)) {
                // Return Asset URL
                return $assetUrl . $file;
            } else {
                throw new Exception('Asset Does Not Exist.');
            }
        } else {

            // $directory does not exist
            throw new Exception('Asset Directory Does Not Exist.');
        }
    }
}