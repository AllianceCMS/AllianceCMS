<?php
namespace Acms\Core\Data;

class Assets
{
    public function getAssetPath($module, $directory, $file)
    {
        $assetDir = WWW_RESOURCES_DIR . '/modules/' . $module . '/assets/' . $directory;
        $assetUrl = WWW_RESOURCES_URL . '/modules/' . $module . '/' . 'assets' . '/' . $directory;

        if (file_exists($assetDir)) {

            if (file_exists($assetDir . '/' . $file)) {
                // Return Asset URL
                return $assetUrl . '/' . $file;
            } else {
                throw new Exception('Asset Does Not Exist.');
            }
        } else {

            // $directory does not exist
            throw new Exception('Asset Directory Does Not Exist.');
        }
    }
}