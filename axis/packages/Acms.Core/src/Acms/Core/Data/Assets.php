<?php
namespace Acms\Core\Data;

class Assets
{
    public function getAssetPath($module, $directory, $file)
    {
        $assetDir = RESOURCE_PATH . 'modules' . DS . $module . DS . 'assets' . DS . $directory . DS;
        $assetUrl = RESOURCE_URL . 'modules' . DS . $module . DS . 'assets' . DS . $directory . DS;

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