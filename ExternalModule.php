<?php

namespace PSUIH\ExternalModule;

use ExternalModules\AbstractExternalModule;

class ExternalModule extends AbstractExternalModule {

    function redcap_every_page_top($project_id) {

        if (!defined('REDCAP_ENTITY_PREFIX')) {
            // Exits gracefully when REDCap Entity is not enabled.
            return;
        }

        // only try to operate on projects page
        // TODO: consider altering home page of sequestered projects
        if (!$_GET['action'] == 'myprojects') {
            return;
        }

        // force completed projects to be exposed
        $_GET["show_completed"] = 1;

        $settings = [
            "pids" => $this->getSequesteredProjectIds(),
            "replacement_text" => $this->getSystemSetting('replacement_text')
        ];

        $this->setJsSettings($settings);
        $this->includeJs("js/ui_hack.js");
    }

    protected function getSequesteredProjectIds() {
        // REDCap won't allow this due to no PID on main page, an error is thrown by core
        // $factory = new \REDCapEntity\EntityFactory();
        // $query_result <- $factory->query('project_ownership')
        //     ->condition('sequestered', true)
        //     ->execute();

        $sql = "SELECT pid FROM redcap_entity_project_ownership WHERE sequestered = 1;";
        $query_result = $this->framework->query($sql, []);

        $projects = [];
        foreach ($query_result as $r) { array_push($projects, $r['pid']); }

        return $projects;
    }

    protected function includeCss($path) {
        echo '<link rel="stylesheet" href="' . $this->getUrl($path) . '">';
    }

    protected function includeJs($file) {
        echo '<script src="' . $this->getUrl($file) . '"></script>';
    }

    protected function setJsSettings($settings) {
        echo '<script>PSUIH = ' . json_encode($settings) . ';</script>';
    }

}
