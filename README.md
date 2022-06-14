# project_sequestration_ui_hack
Displays completed projects as "Sequestered" if they are flagged as such

## Notes on sequestering / unsequestering

This module does not set the sequestered flag nor does it mark projects as completed. It is dependent upon another service to make those data changes where appropriate.

That service would need to set `sequestered = 1` in the table `redcap_entity_project_ownership`. It would also need to set `completed_time = '".NOW."', completed_by = '".db_escape(USERID)."'` in the `redcap_projects` table.

To unsequester a project, it would need to set `sequestered = 0` in the table `redcap_entity_project_ownership` and set `completed_time = NULL, completed_by = NULL` in the `redcap_projects` table.

For a project state reference see the behavior of `ProjectGeneral/change_project_status.php`.
