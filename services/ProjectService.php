<?php

namespace app\services;

use app\models\Project;
use app\models\ProjectPart;
use app\models\ProjectAccess;
use app\models\Role;
use app\models\User;
use app\models\Part;

/**
 * Сервис по работе с проектами
 *
 * @author restlin
 */
class ProjectService {

    public static function createAuthorAccess(Project $project, User $author): ProjectAccess {
        $access = new ProjectAccess();
        $access->project_id = $project->id;
        $access->role_id = Role::INICIATOR;
        $access->user_id = $author->id;
        $access->save();
        return $access;
    }

    public static function createDefaultParts(Project $project) {
        $parts = Part::find()->orderBy('id')->all();
        foreach($parts as $part) {
            $part = new ProjectPart();
            $part->project_id = $project->id;
            $part->part_id = $part->id;
            $part->ready = false;
            $part->save();
        }
    }
}
